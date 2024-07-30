<?php

namespace App\Http\Controllers\Api\UserApp\App;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function startConversation(Request $request)
    {
        $user_id=Auth::id();
        $conversation = Conversation::create([
            'sender_id' => $user_id,
            'receiver_id' => $request->receiver_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Conversation Started successfully',
            'data'=>JsonResource::make($conversation)
        ],201);
    }

    public function getConversations()
    {
        $user_id=Auth::id();

        $conversations = Conversation::where('sender_id', $user_id)
                                    ->orWhere('receiver_id', $user_id)
                                    ->get();

        return response()->json([
            'success' => true,
            'message' => 'Conversations retrieved successfully',
            'data'=>JsonResource::collection($conversations)
        ],200);
    }
}
