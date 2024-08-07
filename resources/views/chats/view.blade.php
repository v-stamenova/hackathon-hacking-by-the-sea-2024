<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Study session - {{$group->topic}}
        </h2>
        <h4 class="font-semibold text-gray-800 leading-tight">
           {{$group->goal}}
        </h4>
    </x-slot>

    <div class="py-9">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-screen">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 h-4/5">
                <livewire:room-chat-component groupId="{{$group->id}}"></livewire:room-chat-component>
            </div>
        </div>
    </div>
</x-app-layout>
