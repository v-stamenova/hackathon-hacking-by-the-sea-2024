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
                            <img src="{{ $sender->profile_photo_url }}" alt="{{ $sender->name }}"
                                 class="rounded-full w-full h-full object-cover">
                        </div>
                    </div>
                @else
                    <div class="flex items-start">
                        @if($message->sender)
                            <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center">
                                <img src="{{ $message->sender->profile_photo_url }}" alt="{{ $message->sender->name }}"
                                     class="rounded-full w-full h-full object-cover">
                            </div>
                            <div class="ml-3 p-2 bg-white rounded-lg shadow">
                                <p class="text-xs text-left text-gray-700">{{$message->sender->name}}</p>
                                <p class="text-sm">{{$message->text}}</p>
                            </div>
                        @else
                            <div
                                class="w-10 h-10 rounded-full overflow-hidden bg-blue-500 text-white flex items-center justify-center">
                                <img src="{{ url('/daan.png') }}" alt="DaanGPT"
                                     class="rounded-full w-full h-full object-cover">
                            </div>
                            <div class="ml-3 p-2 bg-green-50 rounded-lg shadow text-sm relative group w-5/6">
                                <p class="text-xs text-left text-gray-700">DaanGPT</p>
                                <x-markdown class="messageTexts bg-green-50">
                                    {!! $message->text !!}
                                </x-markdown>
                                <button type="button"
                                        class="speakButton absolute p-2 bg-green-50 rounded-full text-gray-700 focus:outline-none speaker-button transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z"/>
                                    </svg>
                                </button>
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
        .relative {
            position: relative;
        }

        .absolute {
            position: absolute;
        }

        .transition-opacity {
            transition: opacity 0.3s;
        }

        .opacity-0 {
            opacity: 0;
        }

        .opacity-100 {
            opacity: 1;
        }

        .group:hover .speaker-button {
            opacity: 1;
        }

        .speaker-button {
            bottom: 0.5rem;
            right: -2rem; /* Adjust this value to position the button to the right of the textbox */
        }

        .size-6 {
            width: 24px;
            height: 24px;
        }

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
            background: linear-gradient(to bottom left, #d4edda, #ffffff, #ffffff);

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
    let audio = null; // Declare a global variable to hold the Audio object
    let isPlaying = false; // Flag to track if audio is currently playing
    const speakButtons = document.getElementsByClassName('speakButton');
    const messageTexts = document.getElementsByClassName('messageTexts');

    for (let i = 0; i < speakButtons.length; i++) {
        speakButtons[i].addEventListener('click', async function speak(event) {
            if (!isPlaying) {
                const response = await fetch('/tts/synthesize', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': `{{ csrf_token() }}`
                    },
                    body: JSON.stringify({text: messageTexts[i].innerText.replace(/<\/[^>]+(>|$)/g, "")})
                });

                const data = await response.json();
                console.log(data);
                if (data.success) {
                    audio = new Audio(data.url);
                    await audio.play();

                    event.target.title = 'Pause';
                    isPlaying = true;
                } else {
                    alert('smth went wrong');
                }
            } else {
                audio.pause();
                // Update UI: Change button text back to "Speak"
                event.target.title = 'Speak';
                isPlaying = false;
            }
        });
    }


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
        shikiElements.forEach(function (element) {
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
