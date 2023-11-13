@props([
    'class' => '',
    'href' => '#',
])

<a class="{{ $class }}" href="{{ $href }}" {{ $attributes }}>
    {{ $slot }}
</a>