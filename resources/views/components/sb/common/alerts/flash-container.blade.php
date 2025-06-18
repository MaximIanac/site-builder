@php
    $types = [
        'success',
        'error',
        'warning',
        'info',
    ];
@endphp

@foreach ($types as $type)
    @if (session($type))
        <x-sb.common.alerts.flash :type="$type" :message="session($type)" />
    @endif
@endforeach
