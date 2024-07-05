<x-app-layout>
    <div class="w-full p-8 overflow-y-auto">
        <div class="pb-5">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Direct messages
            </h2>
            <h4 class="font-semibold text-lg text-gray-800 leading-tight">
                Text all of your friends within the system to help you out
            </h4>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-screen bg-white rounded">
            <ul role="list" class="divide-y divide-gray-300">
                @foreach($users as $user)
                    <a href="{{route('users.show', $user)}}">
                        <li class="flex justify-between gap-x-6 py-5">
                            <div class="flex min-w-0 gap-x-4">
                                <div class="min-w-0 flex-auto">
                                    <p class=" font-semibold leading-6 text-gray-900">{{$user->name}} @if(\Illuminate\Support\Facades\Auth::user()->id == $user->id) (Me) @endif</p>
                                </div>
                            </div>
                            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                <p class="mt-1 text-md leading-5 text-gray-500">{{$user->email}}
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
