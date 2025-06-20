@props(['href' => '#'])

<a href="{{ $href }}"
   {{ $attributes->merge(['class' => "inline-flex uppercase bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-3 rounded-lg text-xs font-semibold transition duration-300 tracking-widest        focus:bg-indigo-700 active:bg-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800" ]) }}
>
    {{ $slot }}
</a>
