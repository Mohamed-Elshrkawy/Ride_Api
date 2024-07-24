<?php

namespace App\Http\Controllers\Api\UserApp\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Country;
use App\Models\User;


class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $country = Country::find($request->country_id);
        User::create(array_merge(
            $request->validated(),
            ['phone_num' => $country->code . $request->phone],
            ['password' => bcrypt($request->password)]

        ));
        return response()->json(['massage'=>'user successfuly create'],200);
    }

}
