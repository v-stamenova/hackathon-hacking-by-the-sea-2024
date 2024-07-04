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
    public $room;
    public $sender;
    public $messages = [];

    public function mount($roomId)
    {
        $this->sender = Auth::user();
        $this->room = Room::find($roomId);
        $this->messages = GroupMessage::where(function ($query) {
            $query->where('room_id', $this->room->id);
        })->get();
    }

    public function sendMessage()
    {
        $message = GroupMessage::create([
            'sender_id' => $this->sender->id,
            'room_id' => $this->room->id,
            'text' => $this->message
        ]);

        broadcast(new GroupMessageSent($message));
        $this->message = '';
    }

    #[On('groupMessageReceived')]
    public function retrieve()
    {
        $this->messages = GroupMessage::where('room_id', $this->room->id)
            ->orderBy('created_at', 'asc')
            ->get();

        $this->lastMessage = $this->messages->last();

        if (strpos($this->lastMessage->text, '@Daan') === 0) {
            $response = Http::post($this->room->url, [
                'message' => $this->lastMessage->text
            ]);

            if ($response->successful()) {
                $responseBody = $response->json();
                $daanMessage = $responseBody['answer'][0]['text']['value'];

                $message = GroupMessage::create([
                    'room_id' => $this->room->id,
                    'text' => $daanMessage
                ]);

                broadcast(new GroupMessageSent($message));
            } else {
                Log::error('Failed to send message to external URL', [
                    'url' => $this->room->url,
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
