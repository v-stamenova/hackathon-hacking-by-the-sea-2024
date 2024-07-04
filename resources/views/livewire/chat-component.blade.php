<div class="flex flex-col h-screen">
    <!-- Chat messages container -->
    <div class="flex-1 overflow-y-auto p-4 bg-gray-100">
        <div id="messages" class="space-y-4">
            <!-- Example message from another user -->
            {{--<div class="flex items-start">
                <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                    U
                </div>
                <div class="ml-3 p-2 bg-white rounded-lg shadow">
                    <p class="text-sm">Hello! How can I help you today?</p>
                </div>
            </div>

            <!-- Example message from current user -->
            <div class="flex items-end justify-end">
                <div class="mr-3 p-2 bg-blue-500 text-white rounded-lg shadow">
                    <p class="text-sm">I have a question about your product.</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-gray-500 text-white flex items-center justify-center">
                    M
                </div>
            </div>--}}

            @foreach($messages as $message)
                {{$message->text}}
            @endforeach
        </div>
    </div>

    <!-- Message input container -->
    <div class="border-t border-gray-300 p-4 bg-white">
        <form id="chat-form" wire:submit.prevent="sendMessage" class="flex items-center space-x-4">
            <input id="message" type="text" wire:model.defer="message" class="flex-1 p-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="Type a message..." />
            <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg shadow">Send</button>
        </form>
    </div>
</div>
