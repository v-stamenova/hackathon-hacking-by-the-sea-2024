<?php

namespace App\Livewire;

use App\Events\GroupMessageSent;
use App\Events\MessageSent;
use App\Models\ChatMessage;
use App\Models\Group;
use App\Models\GroupMessage;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class RoomChatComponent extends Component
{
    public $message;
    public $group;
    public $sender;
    public $messages = [];

    public function mount($groupId)
    {
        $this->sender = Auth::user();
        $this->group = Group::find($groupId);
        $this->messages = GroupMessage::where(function ($query) {
            $query->where('group_id', $this->group->id);
        })->get();
    }

    public function sendMessage()
    {
        $message = GroupMessage::create([
            'sender_id' => $this->sender->id,
            'group_id' => $this->group->id,
            'text' => $this->message
        ]);

        broadcast(new GroupMessageSent($message));
        $this->messages = GroupMessage::where('group_id', $this->group->id)
            ->orderBy('created_at', 'asc')
            ->get();

        $this->message = '';
    }

    #[On('groupMessageReceived')]
    public function retrieve()
    {
        $this->messages = GroupMessage::where('group_id', $this->group->id)
            ->orderBy('created_at', 'asc')
            ->get();

        $lastMessage = $this->messages->last();

        if (strpos($lastMessage->text, '@Daan') === 0) {
            $response = Http::post($this->group->url, [
                'message' => $lastMessage->text
            ]);

            if ($response->successful()) {
                $responseBody = $response->json();
                $daanMessage = $responseBody['answer'][0]['text']['value'];

                $message = GroupMessage::create([
                    'group_id' => $this->group->id,
                    'text' => $daanMessage
                ]);

                broadcast(new GroupMessageSent($message));
            } else {
                Log::error('Failed to send message to external URL', [
                    'url' => $this->group->url,
                    'message' => $this->message,
                    'response' => $response->body()
                ]);
                return;
            }
        }
    }

    public function render()
    {
        return view('livewire.room-chat-component');
    }
}
