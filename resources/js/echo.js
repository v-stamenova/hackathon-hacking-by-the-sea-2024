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

const receiverIds = Array.from({ length: 50 }, (_, i) => i + 1);
const groupIds = Array.from({ length: 50 }, (_, i) => i + 1);


receiverIds.forEach(receiverId => {
    window.Echo.channel(`chat.${receiverId}`)
        .listen('MessageSent', (e) => {
            console.log('MessageSent event received for receiver', receiverId, ':', e);
            Livewire.dispatch('messageReceived', { receiverId: receiverId, message: e.message });
        });
});

groupIds.forEach(groupId => {
    window.Echo.channel(`chat.group.${groupId}`)
        .listen('MessageSent', (e) => {
            console.log('MessageSent event received for receiver', groupId, ':', e);
            Livewire.dispatch('messageReceived', { groupId: groupId });
        });
});

