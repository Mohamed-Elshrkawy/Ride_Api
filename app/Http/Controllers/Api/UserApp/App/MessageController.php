<?php

namespace App\Http\Controllers\Api\UserApp\App;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $sender_id=Auth::id();
        $message = Message::create([
            'conversation_id' => $request->conversation_id,
            'sender_id' =>$sender_id,
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully',
            'data'=>JsonResource::make($message)
        ],201);
    }

    public function getMessages($conversationId)
    {
        $messages = Message::where('conversation_id', $conversationId)->get();

        return response()->json([
            'success' => true,
            'message' => 'Message retrieved successfully',
            'data'=>JsonResource::collection($messages)
        ],200);
    }
}
