<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="font-sans antialiased">
    <x-banner/>

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')


        <div class="flex h-screen bg-gray-100">
            <!-- Sidebar -->
            <div class="w-1/4 bg-white p-6">
                <div class="flex flex-col items-center">
                    <img src="{{ url('/daan.png') }}" alt="DaanGPT"
                         class="rounded-full w-32 h-32 object-cover shadow-lg">
                    <h4 class="text-xl font-semibold text-gray-700 mt-4">DaanGPT</h4>
                    <p class="text-gray-600 text-center">Your AI tutor, here to help you with any learning challenges
                                                         you face.</p>
                </div>
                <nav class="mt-10">
                    <ul class="space-y-2">
                        <x-new-nav-link href="{{ route('dashboard') }}"
                                        :active="request()->routeIs('dashboard')">
                            <x-slot name="icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 7v4h.01M7 7v4h.01M7 7V3m0 4h4m0 0V3m0 4h4m0 0V3m0 4h4M3 11v4h.01M7 11v4h.01M7 11V7m0 4h4m0 0v4m0-4h4m0 0v4m0-4h4m0 0v4m0-4h4m0 0v4m0-4h4"></path>
                                </svg>
                            </x-slot>
                            Dashboard
                        </x-new-nav-link>
                        <x-new-nav-link href="{{ route('groups.index') }}"
                                        :active="request()->routeIs('groups.index')">
                            <x-slot name="icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"></path>
                                </svg>
                            </x-slot>
                            Study groups
                        </x-new-nav-link>
                        <x-new-nav-link href="{{ route('users.index') }}"
                                        :active="request()->routeIs('users.index')">
                            <x-slot name="icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                                </svg>
                            </x-slot>
                            Direct messages
                        </x-new-nav-link>
                    </ul>
                </nav>
            </div>

            <div class="w-full">
                <!-- Main content -->
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>


    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>
