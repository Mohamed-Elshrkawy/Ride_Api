<?php

namespace App\Http\Controllers\Api\UserApp\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Country;
use App\Models\User;
use App\Models\Wallet;


class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $country = Country::find($request->country_id);
        $user=User::create(array_merge(
            $request->validated(),
            ['phone_num' => $country->code . $request->phone],
            ['password' => bcrypt($request->password)]

        ));
        Wallet::create(
            ['user_id'=>$user->id,
            'available_balance'=>0]
        );
        return response()->json([
            'success' => true,
            'message' => 'User successfully created',
            'data'=>null

            ],201);
    }

}
