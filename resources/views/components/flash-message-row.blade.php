@props([
    "title" => true,
])

@if ($errors->any())
<div class="row">
    <div class="col-md-6">
        <x-alert type="danger" title="{{ $title ? 'Error' : '' }}">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert>
    </div>
</div>
@elseif (session('error'))
<div class="row">
    <div class="col-md-6">
        <x-alert type="danger" title="{{ $title ? 'Error' : '' }}">
            {{ session('error') }}
        </x-alert>
    </div>
</div>
@elseif (session('success'))
<div class="row">
    <div class="col-md-6">
        <x-alert type="success" title="{{ $title ? 'Success' : '' }}">
            {{ session('success') }}
        </x-alert>
    </div>
</div>
@endif