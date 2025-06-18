<form
    {{ $attributes->merge(['method' => $method ?? 'POST', 'action' => $action ?? '#', 'id' => $id ?? null]) }}
    @if(strtoupper($method ?? 'POST') !== 'GET' && strtoupper($method ?? 'POST') !== 'POST')
        method="POST"
    @endif
>
    @csrf
    @if(isset($method) && !in_array(strtoupper($method), ['GET', 'POST']))
        @method($method)
    @endif

    {{ $slot }}
</form>
