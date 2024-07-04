import Echo from 'laravel-echo';

import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

// Listen for the MessageSent event on the private channel

window.Echo.channel('chat.2')
    .listen('MessageSent', (e) => {
        console.log('MessageSent event received:', e);
        Livewire.dispatch('messageReceived');
    });

const receiverIds = Array.from({length: 50}, (_, i) => i + 1);

window.Echo.channel(`chat`)
    .listen('MessageSent', (e) => {
        console.log('MessageSent event received for receiver', e);
        Livewire.dispatch('messageReceived', {message: e.message});
    });
window.Echo.channel(`group.chat`)
    .listen('GroupMessageSent', (e) => {
        console.log('GroupMessageSent event received for receiver', e);
        Livewire.dispatch('groupMessageReceived');
    });
