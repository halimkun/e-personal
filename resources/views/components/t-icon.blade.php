@props([
    'icon',
    'class' => '',
])

@php
    $icon = Str::contains($icon, 'ti') ? $icon : 'ti-' . $icon;
@endphp

<i class="ti {{ $icon }} {{ $class }}" {{ $attributes }}></i>