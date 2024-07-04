<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatComponent extends Component
{
    public $message;
    public $receiver;
    public $sender;
    public $messages = [];

    public function mount($receiverId)
    {
        $this->sender = Auth::user();
        $this->receiver = User::find($receiverId);

        $this->messages = ChatMessage::where(function ($query) {
            $query->where('sender_id', $this->sender->id)
                ->where('receiver_id', $this->receiver->id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiver->id)
                ->where('receiver_id', $this->sender->id);
        })->get();
    }

    public function sendMessage()
    {
        $message = ChatMessage::create([
            'sender_id' => $this->sender->id,
            'receiver_id' => $this->receiver->id,
            'text' => $this->message
        ]);

        broadcast(new MessageSent($message));
    }

    #[On('messageReceived')]
    public function retrieve()
    {
        $this->messages = ChatMessage::where(function ($query) {
            $query->where('sender_id', $this->sender->id)
                ->where('receiver_id', $this->receiver->id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiver->id)
                ->where('receiver_id', $this->sender->id);
        })->get();
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}
