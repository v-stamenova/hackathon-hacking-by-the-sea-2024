<div class="flex flex-col h-screen">
    <!-- Chat messages container -->
    <div class="flex-1 overflow-auto p-4 bg-gray-100">
        <div id="messages" class="space-y-4">
            @foreach($messages as $message)
                @if($message->sender_id == $sender->id)
                    <div class="flex items-end justify-end">
                        <div class="mr-3 p-2 bg-blue-500 text-white rounded-lg shadow">
                            <p class="text-sm">{{$message->text}}</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gray-500 text-white flex items-center justify-center">
                            <img src="{{ $sender->profile_photo_url }}" alt="{{ $sender->name }}" class="rounded-full w-full h-full object-cover">
                        </div>
                    </div>
                @else
                    <div class="flex items-start">
                        @if($message->sender)
                            <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                                <img src="{{ $message->sender->profile_photo_url }}" alt="{{ $message->sender->name }}" class="rounded-full w-full h-full object-cover">
                            </div>
                            <div class="ml-3 p-2 bg-white rounded-lg shadow">
                                <p class="text-sm">{{$message->text}}</p>
                            </div>
                        @else
                            <div class="ml-3 p-2 bg-white rounded-lg shadow text-sm">
                                <x-markdown>
                                    {!! $message->text !!}
                                </x-markdown>
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <!-- Loading indicator -->
    <div wire:loading class="flex items-center justify-center h-10 bg-gray-100">
        <p>Loading...</p>
    </div>
    <!-- Message input container -->
    <div class="border-t border-gray-300 p-4 bg-white">
        <form id="chat-form" wire:submit.prevent="sendMessage" class="flex items-center space-x-4">
            <input id="message" type="text" wire:model.defer="message"
                   class="flex-1 p-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"
                   placeholder="Type a message..."/>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg shadow">Send</button>
        </form>
    </div>
</div>
