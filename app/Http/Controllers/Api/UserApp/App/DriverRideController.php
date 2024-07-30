<?php

namespace App\Http\Controllers\Api\UserApp\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserApp\App\ReviewRequest;
use App\Http\Resources\DriverRideResource;
use App\Models\Review;
use App\Models\Ride;
use App\Models\User;
use App\Notifications\UserApp\ReviewNotification;
use Illuminate\Support\Facades\Auth;

class DriverRideController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $rides = $user->rides_driver()->wherePivot('status', null)->get();

        return response()->json([
            'success' => true,
            'message' => 'Rides retrieved successfully',
            'data' => DriverRideResource::collection($rides),
        ], 200);
    }
    public function accept($id)
    {
        $user_id = Auth::id();

        $ride = Ride::find($id);

        if ($ride) {
            $ride->update([
                'status' => 'Driver Underway',
            ]);

            $ride->driversRide()->updateExistingPivot($user_id, ['status' => 'Accept']);

            return response()->json([
                'success' => true,
                'message' => 'Driver Accepted successfully',
                'data' => new DriverRideResource($ride->fresh()),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ride not found',
                'data' => null,
            ], 404);
        }
    }

    public function startRide($id)
    {
        $ride = Ride::find($id);
        $user_id = Auth::id();

        if ($ride) {
            $ride->update([
                'status' => 'Underway',
                'driver_id' => $user_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Ride started successfully',
                'data' => new DriverRideResource($ride->fresh()),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ride not found',
                'data' => null,
            ], 404);
        }
    }

    public function cancel($id)
    {

        $ride = Ride::find($id);

        if ($ride) {

            $ride->update([
                'status' => 'wait',
                'driver_user' => null,
            ]);


            $ride->driversRide()->updateExistingPivot(Auth::id(), ['status' => null]);


            return response()->json([
                'success' => true,
                'message' => 'Driver Canceled successfully',
                'data' => null,
            ]);
        } else {

            return response()->json([
                'success' => false,
                'message' => 'Ride not found',
                'data' => null,
            ], 404);
        }
    }

    public function rideDone($id)
    {
        $ride = Ride::find($id);

        if ($ride) {

            $ride->update([
                'status' => 'done',
            ]);


            $user = $ride->user;
            $driver = $ride->driver;

            if ($user && $driver) {
                if($user->wallet->available_balance>=$ride->price){
                $user->wallet->update(['available_balance' => $user->wallet->available_balance - $ride->price]);
                $driver->wallet->update(['available_balance' => $driver->wallet->available_balance + $ride->price-5]);
                }else{
                    return ' اوعي تنزلة من العربية ';
                }


                $ride->driversRide()->detach($driver->id);
            }

            return response()->json([
                'success' => true,
                'message' => 'Ride Done successfully',
                'data' => null,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ride not found',
                'data' => ['ride prise'=>$ride->price-5],
            ], 404);
        }
    }
    public function review(ReviewRequest $request)
    {
        $ride = Ride::find($request->ride_id);
        $driver_id = Auth::id();
        $user_id = $ride->user_id;

        $reviewData = $request->validated();
        $reviewData['reviewable_id'] = $user_id;
        $reviewData['reviewable_type'] = User::class;

        $review = Review::create($reviewData);

        $user = User::find($user_id);
        $user->notify(new ReviewNotification($review));

        return response()->json([
            'success' => true,
            'message' => 'Review Created successfully',
            'data' => $review,
        ], 201);
    }
}
