<?php

namespace App\Http\Controllers\Api\UserApp\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserApp\App\UpdateUserRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileUserController extends Controller
{
    public function updateProfile(UpdateUserRequest $request){
        $user=Auth::user();

        $user->update(array_merge($request->validated()));

        return response()->json(['message' => 'Profile updated successfully.'],200);
    }
    public function show()
    {
        $user = Auth::user()->get();
        return UserResource::collection($user);
    }

}
