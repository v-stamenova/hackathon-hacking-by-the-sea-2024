<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to DaanGPT</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.1.2/tailwind.min.css');
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-800">
    <div class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Welcome to DaanGPT
                </h1>
                <p class="mt-4 text-lg text-gray-700">
                    Your AI Tutor and Study Companion
                </p>
            </div>
            <div class="flex space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="px-4 py-2 border border-transparent text-base font-medium rounded-md text-[#2e1a34] bg-emerald-600 hover:bg-emerald-700">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 border border-transparent text-base font-medium rounded-md text-[#2e1a34] bg-emerald-600 hover:bg-emerald-700">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="px-4 py-2 border border-transparent text-base font-medium rounded-md text-[#2e1a34] bg-emerald-100 hover:bg-emerald-200">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
    <div class="bg-green-50">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-emerald-600 font-semibold tracking-wide uppercase">Why DaanGPT?</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Empower Your Learning Experience
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    DaanGPT helps you connect with classmates and get instant AI assistance for any learning challenge.
                </p>
            </div>
            <div class="mt-10">
                <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-emerald-500 text-[#2e1a34]">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Instant AI Assistance</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Get help from DaanGPT anytime you encounter a problem in your studies. Just ask and get
                            instant, accurate answers.
                        </dd>
                    </div>
                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-emerald-500 text-[#2e1a34]">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"></path>
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Collaborate with Classmates</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Create or join study groups to collaborate with your classmates. Share knowledge, discuss
                            problems, and study together.
                        </dd>
                    </div>
                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-emerald-500 text-[#2e1a34]">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"></path>
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Seamless Communication</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Our chat interface is designed for seamless communication, making it easy to stay connected
                            with your group.
                        </dd>
                    </div>
                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-emerald-500 text-[#2e1a34]">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"></path>
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Organized Sessions</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Keep your study sessions organized with DaanGPT. Track your progress and plan future
                            sessions with ease.
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900">Meet DaanGPT</h3>
                    <p class="mt-4 text-lg text-gray-500">
                        DaanGPT is an AI-powered tutor designed to help you with your studies. Whether you're struggling
                        with a concept or need guidance on your assignments, DaanGPT is here to assist.
                    </p>
                    <p class="mt-4 text-lg text-gray-500">
                        Our advanced AI technology ensures that you get accurate and helpful responses in real-time.
                        Study smarter, not harder, with DaanGPT by your side.
                    </p>
                </div>
                <div class="mt-10 lg:mt-0">
                    <img class="mx-auto w-full rounded-lg shadow-lg" src="{{ url('/daan.png') }}" alt="DaanGPT">
                </div>
            </div>
        </div>
    </div>

    <div class="bg-green-50">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-emerald-600 font-semibold tracking-wide uppercase">Get Started Today</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Join DaanGPT and Enhance Your Learning
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Sign up now and start your journey towards better learning and collaboration.
                </p>
                <div class="mt-8 flex justify-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                               class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-[#2e1a34] bg-emerald-600 hover:bg-emerald-700">
                                Go to Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="px-8 py-3 border border-transparent text-base font-medium rounded-md text-[#2e1a34] bg-emerald-600 hover:bg-emerald-700">
                                Log in
                            </a>
                            <a href="{{ route('register') }}"
                               class="ml-4 px-8 py-3 border border-transparent text-[#2e1a34] text-base font-medium rounded-md text-emerald-700 bg-emerald-100 hover:bg-emerald-200">
                                Register
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white">
        <div class="max-w-7xl mx-auto py-8 px-4 overflow-hidden sm:px-6 lg:px-8">
            <p class="mt-8 text-center text-base text-gray-400">
                &copy; 2024 DaanGPT. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>
