<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Groups') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if(!$groups->isEmpty())
                    <ul class="space-y-4">
                        @foreach($groups as $group)
                            <li class="flex items-center justify-between p-4 bg-gray-50 rounded-lg shadow">
                                <a class="w-full" href="{{ route('groups.show', $group) }}">
                                    <div>
                                        <h2 class="text-xl font-semibold">{{ $group->name }}</h2>
                                        <p class="text-gray-600">{{ $group->description }}</p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>You are not a member of any group!</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
