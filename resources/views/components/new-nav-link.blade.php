@props(['href', 'active' => false])

@php
    $classes = $active
                ? 'text-emerald-700 bg-emerald-100 flex items-center p-2 rounded-md'
                : 'text-gray-700 hover:bg-emerald-100 hover:text-emerald-700 flex items-center p-2 rounded-md';
@endphp

<li>
    <a href="{{ $href }}" class="{{ $classes }}">
        <div class="w-6 h-6">
            {{ $icon }}
        </div>
        <span class="ml-2">{{ $slot }}</span>
    </a>
</li>
