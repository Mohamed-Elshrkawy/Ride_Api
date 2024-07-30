<?php

namespace App\Http\Controllers\Api\UserApp\App;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $user=Auth::user();
        $balance=$user->wallet->available_balance;
        $unreadNotificationsCount = $user->unreadNotifications()->count();

        return response()->json([
            'success' => true,
            'message'=>'welcome to home',
            'data'=>['user'=>UserResource::make($user),
                    'balance'=>$balance,
                    'unreadNotificationsCount'=>$unreadNotificationsCount
            ]
        ],200);
    }
    public function active()
    {
        $user = Auth::user();

        $user->drivers->status = $user->drivers->status === "active" ? "inactive" : "active";
        $user->drivers->save();

        return response()->json([
            'success' => true,
            'message' => 'Status changed successfuly',
            'data' => null
        ], 200);
    }
    public function myNotification()
    {
        $user = Auth::user();
        $notifications = $user->unreadNotifications;
        return response()->json([
            'success' => true,
            'message' => 'Status changed successfuly',
            'data' => NotificationResource::collection($notifications),
        ], 200);
    }
    public function myWallet()
    {
        $user = Auth::user();
        $wallet=$user->wallet;
        return response()->json([
            'success' => true,
            'message' => 'Status changed successfuly',
            'data' => JsonResource::make($wallet),
        ], 200);
    }
}
