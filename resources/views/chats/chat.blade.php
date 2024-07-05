<x-app-layout>
    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-screen">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 h-screen">
                <div class="pb-2">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Direct message {{$user->id}}
                    </h2>

                </div>
                <livewire:chat-component receiverId="{{$user->id}}"></livewire:chat-component>
            </div>
        </div>
    </div>
</x-app-layout>
