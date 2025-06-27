<div {{ $attributes->merge(['class' => 'bg-bg-secondary rounded-2xl p-4 shadow-xl']) }}>
    @isset($header)
        <h4 class="text-base">{{ $header }}</h4>
        <hr class="my-4 border-gray-300/50 dark:border-gray-600/50">
    @endisset

    {{ $slot }}
</div>
