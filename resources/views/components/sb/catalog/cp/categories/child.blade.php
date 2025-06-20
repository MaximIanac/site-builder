@props([
    'categories' => [],
    'level' => 1,
])
<div
    x-data="{ open: false }"
    class="absolute shadow-xl space-y-1 w-full z-10 {{ $level === 1 ? 'top-full left-0' : 'ml-2 left-full top-0' }}"
    x-cloak
    x-transition
>
    @foreach ($categories as $category)
        <div class="
            relative border-2 border-transparent bg-blue-100 dark:bg-blue-950 rounded-lg first:rounded-t-none
            {{ request()->query('chosen_category') === $category->slug ? 'border-accent-thirdly' : 'border-transparent' }}
        ">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 p-2 rounded-b-lg transition-all duration-300 cursor-pointer">
                    <svg @click="open = !open" class="w-4 h-4 text-text-secondary transform transition-transform duration-200 {{ !$category->children || $category->children->isEmpty() ? 'hidden' : '' }}" :class="{ 'rotate-90': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>

                    <form action="{{ url()->current() }}" method="get">
                        <input type="hidden" name="chosen_category" value="{{ $category->slug }}">
                        <button type="submit" class="text-sm font-medium text-text-primary truncate">
                            {{ $category->name }}
                        </button>
                    </form>
                </div>

                <div class="flex items-center justify-end">
                    <a href="{{ route('cp.content.modules.catalog.categories.edit', $category->slug) }}" class="p-1 text-accent-primary hover:text-accent-secondary" title="Edit {{ $category->name }}">
                        <x-icons.edit />
                    </a>
                    <button class="p-1 text-red-400 hover:text-red-500" title="Delete {{ $category->name }}">
                        <x-icons.trash />
                    </button>
                </div>
            </div>

            @if ($category->children && $category->children->isNotEmpty())
                <div x-show="open">
                    <x-sb.catalog.cp.categories.child :categories="$category->children" :level="$level + 1" />
                </div>
            @endif
        </div>
    @endforeach
</div>
