<form
{{--    x-data="formChangeWarning()"--}}
{{--    x-init="init($el)"--}}
{{--    @submit="submitted = true"--}}

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

<script>
    // function formChangeWarning() {
    //     return {
    //         initialData: '',
    //         submitted: false,
    //
    //         init(form) {
    //             this.initialData = new FormData(form);
    //             window.addEventListener('beforeunload', e => {
    //                 if (this.submitted) return;
    //
    //                 e.preventDefault();
    //                 e.returnValue = 'Вы уверены, что хотите покинуть страницу? Несохранённые данные будут утеряны.';
    //                 return;
    //             });
    //         }
    //     }
    // }
</script>
