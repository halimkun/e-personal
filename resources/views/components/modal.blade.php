@props([
    'name',
    'title',
    'size' => 'lg',
])

{{-- if size not contains modal- --}}
@if (!Str::contains($size, 'modal-'))
    @php
        $size = 'modal-' . $size;
    @endphp
@endif

<!-- Modal -->
<div class="modal fade" id="{{ $name }}" tabindex="-1" data-bs-backdrop="static" aria-labelledby="{{ $name }}-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable {{ $size }}">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ $name }}-label">{{ $title }}</h1>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $slot  }}
            </div>
        </div>
    </div>
</div>