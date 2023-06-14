<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Events\MessageSent;
use App\Models\Conversation;


class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat');
    }

    public function fetchMessages(Request $request)
    {
        $conversation = Conversation::firstOrCreate(['sender_id'=> $request->route('user_id'), 'receiver_id'=> $request->route('owner_id')]);
        $messages = Message::where('conversation_id', $conversation['id'])->with(['attachment', 'user'])->get();
       
        $conversation['messages'] = $messages;
        return $conversation;
    }

    public function fetchConversations(Request $request)
    {
        $user = Auth::user();
        $conversations = Conversation::Where('receiver_id','=', $user->id)->with('sender')
        ->get();
       
       return $conversations;
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $conversation = Conversation::firstOrCreate(['sender_id'=> $request->input('user_id'), 'receiver_id'=>$request->input('owner_id')]);

        $message = new Message();
        $message->message = $request->input('message');
        $message->conversation_id = $conversation->id;
        $message->user_id = $user->id;
        $message->attachment = null;
        $message->save();

        broadcast(new MessageSent($user, $message, $conversation))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
