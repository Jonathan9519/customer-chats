<?php

namespace App\Events;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{

    public $user;
    public $message;
    public $conversation;

    public function __construct(User $user, Message $message, Conversation $conversation)
    {
        $this->user = $user;
        $this->message = $message;
        $this->conversation = $conversation;
    }
    
    public function broadcastOn()
    {
        return new PrivateChannel('chat'.$this->conversation->id);
    }
    
}
