@props([
    "title" => true,
])

@if ($errors->any())
<x-alert type="danger" title="{{ $title ? 'Error' : '' }}">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li class="text-sm">{{ $error }}</li>
        @endforeach
    </ul>
</x-alert>
@elseif (session('error'))
<x-alert type="danger" title="{{ $title ? 'Error' : '' }}">
    {{ session('error') }}
</x-alert>
@elseif (session('success'))
<x-alert type="success" title="{{ $title ? 'Success' : '' }}">
    {{ session('success') }}
</x-alert>
@endif