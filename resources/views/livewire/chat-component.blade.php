<div x-data x-init="$nextTick(() => { scrollToBottom(); })" class="flex flex-col h-5/6">
    <!-- Chat messages container -->
    <div id="messages-container" class="flex-1 overflow-auto p-4 bg-gray-100">
        <div id="messages" class="space-y-4">
            @foreach($messages as $message)
                @if($message->sender_id == $sender->id)
                    <div class="flex items-end justify-end">
                        <div class="mr-3 p-2 bg-blue-500 text-white rounded-lg shadow">
                            <p class="text-xs text-blue-100 text-right">Me</p>
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
                                <p class="text-xs text-left text-gray-700">{{$message->sender->name}}</p>
                                <p class="text-sm">{{$message->text}}</p>
                            </div>
                        @else
                            <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                                <img src="{{ url('/daan.png') }}" alt="DaanGPT"  class="rounded-full w-32 h-32 object-cover">
                            </div>
                            <div class="ml-3 p-2 bg-green-50 rounded-lg shadow text-sm">
                                <p class="text-xs text-left text-gray-700">DaanGPT</p>
                                <x-markdown class="bg-green-50">
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
    <div wire:loading class="mr-5 flex items-center justify-center h-10">
        <div class="pl-5 typing-indicator flex items-center space-x-2">
            <div class="bubble">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        </div>
    </div>
    <!-- Message input container -->
    <div class="border-t border-gray-300 p-4 bg-white">
        <form id="chat-form" wire:submit.prevent="sendMessage" class="flex items-center space-x-4">
            <input id="message" type="text" wire:model.defer="message"
                   class="flex-1 p-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"
                   placeholder="Type a message..."/>
            <button type="submit" class="bg-emerald-500 text-white p-2 rounded-lg shadow">Send</button>
        </form>
    </div>

    <style>
        /* Custom scrollbar styles */
        #messages-container::-webkit-scrollbar {
            width: 12px; /* Width of the scrollbar */
        }

        #messages-container::-webkit-scrollbar-track {
            background: transparent; /* Transparent background for the scrollbar track */
        }

        #messages-container::-webkit-scrollbar-thumb {
            background: rgba(128, 128, 128, 0.5); /* Gray color with 50% opacity */
            border-radius: 9999px; /* Fully rounded like a pill */
        }

        #messages-container::-webkit-scrollbar-thumb:hover {
            background: rgba(85, 85, 85, 0.5); /* Slightly darker gray with 50% opacity on hover */
        }

        /* For smooth scrolling */
        #messages-container {
            scroll-behavior: smooth;
            background: linear-gradient(to bottom left, #d4edda,#ffffff, #ffffff);

        }

        .bg-green-50 code,
        .bg-green-50 pre {
            background-color: #f0fdf4 !important; /* Ensure the background color matches bg-green-50 */
        }

        .typing-indicator {
            display: flex;
            align-items: center;
        }

        .bubble {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 40px;
            height: 20px;
            padding: 5px;
            background-color: #e0e0e0;
            border-radius: 20px;
            position: relative;
        }

        .dot {
            width: 6px;
            height: 6px;
            background-color: #555;
            border-radius: 50%;
            animation: typing 1s infinite;
        }

        .dot:nth-child(2) {
            animation-delay: 0.2s;
        }

        .dot:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {
            0% {
                transform: translateY(0);
                opacity: 0.2;
            }
            50% {
                transform: translateY(-4px);
                opacity: 1;
            }
            100% {
                transform: translateY(0);
                opacity: 0.2;
            }
        }
    </style>

</div>

<script>
    document.addEventListener('livewire:load', function () {
        scrollToBottom();
    });

    document.addEventListener('livewire:update', function () {
        scrollToBottom();
    });

    // Listen for the groupMessageReceived event
    window.addEventListener('groupMessageReceived', function () {
        scrollToBottom();
    });

    function scrollToBottom() {
        let messagesContainer = document.getElementById('messages-container');
        messagesContainer.scrollTop = messagesContainer.scrollHeight + 15;

        let shikiElements = document.querySelectorAll('.shiki');
        shikiElements.forEach(function(element) {
            element.style = '';
            // Remove any existing background color classes to avoid conflicts
            element.classList.remove('bg-white', 'bg-gray-100', 'bg-blue-500'); // Adjust based on your used classes
            // Add the bg-green-50 class
            element.classList.add('bg-green-50');
            // Remove any inline color styles
            element.style.color = ''; // Reset inline color style if previously set to #fff
        });
    }
</script>
