<x-app-layout>
    <!-- Main content -->
    <div class="w-full p-8 overflow-y-auto">
        <div class="bg-white shadow-xl sm:rounded-lg p-6">
            <h3 class="text-2xl font-semibold text-gray-700 mb-4">Welcome to the Learning Platform</h3>
            <p class="text-gray-600 mb-4">Connect with your classmates to study together and call on our AI tutor, Daan,
                                          whenever you need help. Enhance your learning experience with collaborative
                                          tools and instant AI assistance.</p>
            <div class="mt-6">
                <h4 class="text-xl font-semibold text-gray-700">Study groups</h4>
                <ul class="mt-2 space-y-2">
                    <!-- Replace with dynamic chat items -->
                    @foreach(Auth::user()->groups()->take(3)->get() as $group)
                        <a href="{{route('groups.show', $group)}}">
                            <li class="bg-gray-50 p-4 rounded-md shadow-md hover:bg-gray-100">{{$group->topic}}</li>
                        </a>
                        <hr>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="mt-6 bg-white shadow-xl sm:rounded-lg p-6">
            <h3 class="text-2xl font-semibold text-gray-700 mb-4">Announcements</h3>
            <ul class="mt-2 space-y-2">
                <!-- Replace with dynamic announcement items -->
                <li class="bg-gray-50 p-4 rounded-md shadow-md ">Coming soon: Speech to text</li>
                <li class="bg-gray-50 p-4 rounded-md shadow-md ">Do you feel like you are missing something? Request Feature
                </li>
                <li class="bg-gray-50 p-4 rounded-md shadow-md hover:bg-gray-100">This is developed by Tech Titans
                </li>
            </ul>
        </div>
    </div>
</x-app-layout>
