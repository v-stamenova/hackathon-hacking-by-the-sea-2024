<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All sessions
        </h2>
        <h4 class="font-semibold text-gray-800 leading-tight">
            This includes sessions you've created yourself and/or you've been invited to
        </h4>
    </x-slot>

    <div class="py-9">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-screen bg-white rounded">
            <ul role="list" class="divide-y divide-gray-300">
                @foreach($groups as $group)
                    <a href="{{route('groups.show', $group)}}">
                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex min-w-0 gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class=" font-semibold leading-6 text-gray-900">{{$group->topic}}</p>
                                    <p class="mt-1 truncate text-sm leading-5 text-gray-500">{{$group->goal}}</p>
                                </div>
                            </div>
                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                <p class="mt-1 text-xs leading-5 text-gray-500">Last used on
                                    <time datetime="2023-01-23T13:23Z">{{$group->lastUsed()}}</time>
                                </p>
                                <p class="mt-1 text-xs leading-5 text-gray-500">Created on
                                    <time datetime="2023-01-23T13:23Z">{{$group->created_at}}</time>
                                </p>
                            </div>
                        </li>
                    </a>
                    <hr>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
