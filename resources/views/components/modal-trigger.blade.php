@props([
    "class" => "",
    "toggle" => "modal",
    "target"
])

@if (strpos($target, "#") === false)
    @php
        $target = "#{$target}";
    @endphp
@endif


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary {{ $class }}" data-bs-toggle="{{ $toggle }}" data-bs-target="{{ $target }}" {{ $attributes }}>
    {{ $slot }}
</button>