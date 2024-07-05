<x-app-layout>
    <div class="w-full p-8 overflow-y-auto">
        <div class="flex justify-between items-center pb-5">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    Study group
                </h2>
                <h4 class="font-semibold text-lg text-gray-800 leading-tight">
                    You can see all the sessions you've created or you were invited to by friends.
                </h4>
            </div>
            <div>
                <a href="{{ route('groups.create') }}" class="bg-emerald-500 text-white px-4 py-2 rounded-md shadow hover:bg-emerald-600">
                    Create new group
                </a>
            </div>
        </div>

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
