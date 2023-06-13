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
       $conversations = Conversation::where('sender_id','=', Auth::user()->id)
       ->orWhere('receiver_id','=', Auth::user()->id)
       ->get();
    //    return $conversations->where('receiver_id', $request->route('owner_id'))->first()['id'];
       if (sizeof($conversations) !== 0 && isset($conversations->where('receiver_id', $request->route('owner_id'))->first()['id'])) {
        $conversation = $conversations->where('receiver_id', $request->route('owner_id'))->first();
        $messages = Message::where('conversation_id', $conversation['id'])->with(['attachment', 'user'])->get();
       
        $conversation['messages'] = $messages;
        return $conversation;
       }
       
       return ['messages'=>[]];
       
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $conversation = Conversation::firstOrCreate(['sender_id'=>Auth::user()['id'], 'receiver_id'=>$request->input('owner_id')]);

        $message = new Message();
        $message->message = $request->input('message');
        $message->conversation_id = $conversation->id;
        $message->user_id = $user->id;
        $message->attachment = null;
        $message->save();
        broadcast(new MessageSent($user, $message))->toOthers();

        return ['status' => 'message sent'];
    }
}
