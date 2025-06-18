@props([
    'disabled' => false,
    'placeholder' => 'Search...',
])

<div class="relative">
    <input
        @disabled($disabled)
        placeholder="{{$placeholder}}"
        type="text"
        {{ $attributes->merge(['class' => "p-2 pl-8 text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"]) }}
    >
    <svg class="absolute left-2 top-1/2 -translate-y-1/2 w-4 h-4 stroke-gray-300 dark:stroke-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
    </svg>
</div>
