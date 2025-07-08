@props([
    'href',
    'title',
    'icon',
    'active' => false,
])

<li class="group">
    <a href="{{ $href }}"
       class="flex items-center gap-3 px-3 py-2.5 text-sm rounded-lg transition-all
       {{ $active ? 'bg-gray-700/50 text-white font-medium shadow-md' : 'hover:bg-gray-700/30 text-gray-400 hover:text-gray-200' }}">

        <span class="relative flex items-center justify-center">
            {{ $icon }}
        </span>

        {{ $title }}

        @unless($active)
            <span class="!-rotate-90 ml-auto group-hover:opacity-100 opacity-0 duration-150">
                <x-sb.common.icons.arrow class="text-blue-400 animate-bounce-y" />
            </span>
        @endunless
    </a>
</li>
