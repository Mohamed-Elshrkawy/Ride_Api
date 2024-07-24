<?php

namespace App\Http\Controllers\Api\UserApp\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserApp\App\LocationRequest;
use Illuminate\Support\Facades\Auth;


class UserLocationController extends Controller
{
    public function updateLocation(LocationRequest $request){
        $user=Auth::user();

        $user->update(['location' => [
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'location_name' => $request->location_name,
            ],]);

        return response()->json(['message' => 'Location updated successfully.'],200);
    }
    public function show()
    {
        $user=Auth::user();
        $location=$user->location;
        return response()->json(['location'=>$location]);
    }


}
