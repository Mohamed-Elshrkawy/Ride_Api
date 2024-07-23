<?php

namespace App\Http\Controllers\Api\UserApp\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserApp\App\LocationRequest;
use App\Http\Requests\UserApp\App\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UpdateUserController extends Controller
{
    public function updateProfile(UpdateUserRequest $request){
        $user=Auth::user();

        $user->update(array_merge($request->validated()));

        return response()->json(['message' => 'Profile updated successfully.'],200);

    }
    public function updateLocation(LocationRequest $request){
        $user=Auth::user();

        $user->update(['location' => [
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'location_name' => $request->location_name,
            ],]);

        return response()->json(['message' => 'Location updated successfully.'],200);

    }
}
