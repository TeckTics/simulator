<?php

namespace App\Http\Controllers;

use App\Events\PublicEvent;
use App\Models\ChatMessage;
use Pusher\Pusher;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use App\Events\MessageSent;

class ChatController extends Controller
{
    public function SendMessage(Request $request)
    {
        // return response()->json(['message' => "s"], 200);
        $data = $request->all();
        $data['user_id'] = Auth::guard('appuser')->user()->id;
        $message = ChatMessage::create($data);
        // broadcast(new MessageSent($message));
        return $message;
    }

    public function SendMessageUser(Request $request)
    {
        // return response()->json(['message' => "s"], 200);
        $data = $request->all();
        $data['user_id'] = Auth::guard('appuser')->user()->id;
        $user = User::find(Auth::guard('appuser')->user()->id);
        $message = ChatMessage::create($data);
        broadcast(new MessageSent($message, $user));
        return $message;
    }

    public function LoadThePreviousMessages()
    {
        $messages = ChatMessage::query('user.pseudo', 'chat_messages.id', 'chat_messages.text')
            ->join("users", 'users.id', '=', 'chat_messages.user_id')
            ->orderBy('chat_messages.id', 'asc')
            ->get();
        return $messages;
    }
    public function index()
    {
        return view('admin.chat.index');
    }
}
