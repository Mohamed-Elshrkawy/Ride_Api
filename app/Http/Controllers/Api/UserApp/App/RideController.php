<?php

namespace App\Http\Controllers\Api\UserApp\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserApp\App\CreateRideRequest;
use App\Http\Requests\UserApp\App\ReviewRequest;
use App\Http\Resources\RideResource;
use App\Models\Review;
use App\Models\Ride;
use App\Models\User;
use App\Notifications\UserApp\CreateRideNotification;
use App\Notifications\UserApp\ReviewNotification;
use App\Services\NearbyDriversService;
use Illuminate\Support\Facades\Auth;

class RideController extends Controller
{
    protected $nearbyDriversService;

    public function __construct(NearbyDriversService $nearbyDriversService)
    {
        $this->nearbyDriversService = $nearbyDriversService;
    }

    public function create(CreateRideRequest $request)
    {
        $user = Auth::user();

        $ride = Ride::create(array_merge(
            $request->validated(),
            ['user_id' => $user->id],
            ['price' => $request->distance * 10]
        ));

        $latitude = $request->start_location['latitude'];
        $longitude = $request->start_location['longitude'];
        $drivers = $this->nearbyDriversService->getNearbyDrivers($latitude, $longitude);
        // if($drivers){
            foreach ($drivers as $driver) {
                $ride->driversRide()->attach($driver->id);
                $driver->notify(new CreateRideNotification($ride));
            }

        // }else{
        //     $ride->status='no driver in this location';
        //     $ride->save();

        // }
        return response()->json([
            'message' => 'Ride Created successfully',
            'data' => RideResource::make($ride->fresh()),
        ], 201);
    }


    public function index()
    {
        $id = Auth()->id();
        $rides = Ride::where('user_id', $id)->paginate(4);

        return RideResource::collection($rides)->additional([
            'message' => 'Ride successfully retrieved',
            'status' => 'success',
        ]);
    }

    public function cancel($id)
    {
        $ride = Ride::find($id);
        $ride->update(['status' => 'canceled']);

        return response()->json([
            'success' => true,
            'message' => 'Ride Canceled Successfully',
            'data' => new RideResource($ride)
        ], 200);
    }
    public function review(ReviewRequest $request)
    {
        $ride = Ride::find($request->ride_id);
        $user_id = Auth::id();
        $driver_id = $ride->driver_id;

        $reviewData = $request->validated();
        $reviewData['reviewable_id'] = $driver_id;
        $reviewData['reviewable_type'] = User::class; 

        $review = Review::create($reviewData);

        $driver = User::find($driver_id);
        $driver->notify(new ReviewNotification($review));

        return response()->json([
            'success' => true,
            'message' => 'Review Created successfully',
            'data' => $review,
        ], 201);
    }
}
