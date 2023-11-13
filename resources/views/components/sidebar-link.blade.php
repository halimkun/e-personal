@props([
    'href' => '#',
    'class' => 'sidebar-link',
    'text',
    'icon',
])

{{-- if in icon not contain ti add them --}}
{{-- example layout-dashboard convert to ti-layout-dashboard --}}
@php
    $icon = Str::contains($icon, 'ti') ? $icon : 'ti-' . $icon;
@endphp

<x-link href="{{ $href }}" class="{{ $class }}" aria-expanded="false">
    <span>
        <i class="ti {{ $icon }}"></i>
    </span>
    <span class="hide-menu">{{ $text }}</span>
</x-link>