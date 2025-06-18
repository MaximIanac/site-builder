@props(['href' => '#'])

<a href="{{ $href }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg text-sm font-medium transition duration-300">
    {{ $slot }}
</a>
