@props([
    'type' => 'success',
    'title' => '',
    'dismissable' => true
])

{{-- switch  case for type of alert make variable named t --}}
<?php 
    switch ($type) {
        case 'success':
            $t = 'success';
            break;
        case 'primary':
            $t = 'primary';
            break;
        case 'danger':
            $t = 'danger';
            break;
        case 'warning':
            $t = 'warning';
            break;
        case 'info':
            $t = 'info';
            break;
        case 'light':
            $t = 'light';
            break;
        default:
            $t = 'secondary';
            break;
    }
?>

<div class="alert alert-{{ $t }} {{ $dismissable ? 'alert-dismissible' : '' }} fade show" role="alert">
    {{-- if title not blank --}}
    @if ($title != '')
        <h5 class="alert-heading fs-3 fw-bold">{{ $title }}</h5>
    @endif

    {{ $slot }}
    
    {{-- if dismissable is true --}}
    @if ($dismissable)
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>