<?php

namespace App\Http\Controllers\Api\UserApp\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserApp\App\CreateRideRequest;
use App\Http\Resources\RideResource;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RideController extends Controller
{
    public function create(CreateRideRequest $request)
    {
        $user =Auth::user();

        $ride=Ride::create(array_merge(
            $request->validated(),
            ['user_id'=>$user->id])
        );
        return response()->json([
            'massage'=>'Ride Created successfully',
            'data'=>new RideResource($ride),
    ],200);
    }
    public function index()
    {

        $id=Auth::user()->id;


        $rides = Ride::where('user_id', $id)->first();
        return RideResource::make($rides)->additional([
            'massage'=>'Ride successfully get',
            'status'=> 'success',

        ]);

    }

    public function cancel($id)
    {
        $ride=Ride::find($id);
        $ride->update(['status'=>'canceled']);

        return response()->json([
            'massage'=>'Ride Canceled Successfuly',
            'data'=>new RideResource($ride)
        ],200);
    }
}
