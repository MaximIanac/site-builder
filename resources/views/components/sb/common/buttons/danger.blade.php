<button
    {{ $attributes->merge(['class' => "uppercase bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg text-xs font-semibold transition duration-300 tracking-widest focus:bg-red-700 active:bg-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"]) }}
>
    {{ $slot }}
</button>
