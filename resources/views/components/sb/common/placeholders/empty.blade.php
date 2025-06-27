@props(['message' => ''])

<span
    {{ $attributes->merge(['class' => "font-mono uppercase text-gray-300 dark:text-gray-700"]) }}
>
    {{$message ?? $slot}}
</span>

