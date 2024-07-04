<?php

namespace App\Livewire;

use App\Events\GroupMessageSent;
use App\Models\ChatMessage;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class GroupChatComponent extends Component
{
    public $message;
    public $sender;
    public $group;
    public $messages = [];

    public function mount($groupId)
    {
        $this->group = Group::find($groupId);
        $this->sender = Auth::user();

        $this->messages = ChatMessage::where('group_id', $this->group->id)->get();
    }

    public function sendMessage()
    {
        $message = ChatMessage::create([
            'sender_id' => $this->sender->id,
            'group_id' => $this->group->id,
            'text' => $this->message
        ]);

        broadcast(new GroupMessageSent($message));
        $this->message = '';
    }

    #[On('messageReceived')]
    public function retrieve()
    {
        $this->messages = ChatMessage::where('group_id', $this->group->id)->get();
    }

    public function render()
    {
        return view('livewire.chat-component');
    }
}
