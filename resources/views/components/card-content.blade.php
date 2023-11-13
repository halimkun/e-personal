@props([
    'title' => '',
    'class' => '',
])

<div class="card {{ $class }}" {{ $attributes }}>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            @if ($title)
                <h5 class="card-title fw-semibold">{{ $title }}</h5>
            @endif
            
            @isset($action)
                {{ $action }}
            @endisset
        </div>
        <div class="mb-0">
            {{ $slot  }}
        </div>
    </div>
</div>