<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.ts'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col bg-[var(--bg-primary)]">
            @include('layouts.cp.partials.header')

            <div class="flex flex-1 my-6 mx-1">
                <div class="w-64"></div>
                <div class="fixed h-full w-64">
                    @include('layouts.cp.partials.nav')
                </div>

                <main class="flex-1">
                    <div class="max-w-7xl mx-auto px-4 text-[var(--text-primary)]">
                        <div class="mb-6">
                            {!! app('breadcrumbs')->render() !!}
                        </div>

                        @yield('content')
                    </div>
                </main>
            </div>

            <x-sb.common.alerts.flash-container />

            @stack('scripts')
        </div>
    </body>
</html>
