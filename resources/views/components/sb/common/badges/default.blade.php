<span {{ $attributes->merge([
        'class' => 'inline-flex items-center max-w-[100px]
            px-1.5 py-0.5 text-xs font-medium rounded-full transition-all duration-200
            bg-gray-200 dark:bg-gray-700 text-text-primary
            hover:bg-gray-300 dark:hover:bg-gray-600'
    ])}}
>
    {{ $slot }}
</span>
