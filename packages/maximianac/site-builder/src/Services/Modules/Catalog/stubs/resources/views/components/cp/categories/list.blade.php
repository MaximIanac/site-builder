@props([
    'categories' => [],
])

<div class="bg-bg-secondary rounded-2xl p-4 shadow-xl flex items-center justify-between">
    <div class="flex items-center flex-wrap gap-3">
        <div class="p-2 bg-bg-primary border-2 rounded-lg transition-all duration-300 cursor-pointer min-w-[50px] {{ !request()->query('chosen_category') ? 'border-accent-thirdly' : 'border-transparent' }}">
            <form action="{{ url()->current() }}" method="get">
                <button type="submit" class="text-sm font-medium text-text-primary truncate">
                    All
                </button>
            </form>
        </div>

        @foreach ($categories as $category)
            <div x-data="{ open: false }" class="relative group" @click.outside="open = false">
                <div
                    class="
                        flex justify-between items-center gap-2 p-2 bg-bg-primary border-2 rounded-lg cursor-pointer min-w-[50px]
                        {{ request()->query('chosen_category') === $category->slug ? 'border-accent-thirdly' : 'border-transparent' }}
                    "
                    :class="{'rounded-b-none': open}"
                >
                    <div class="flex items-center gap-2">
                        <svg
                            class="w-4 h-4 text-text-secondary transform transition-transform duration-200 {{ !$category->children || $category->children->isEmpty() ? 'hidden' : '' }}"
                            :class="{ 'rotate-90': open }"
                            @click="open = !open"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                        >
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
                        <button class="p-1 text-accent-primary hover:text-accent-secondary" title="Edit {{ $category->name }}">
                            <x-icons.edit />
                        </button>
                        <button class="p-1 text-red-400 hover:text-red-500" title="Delete {{ $category->name }}">
                            <x-icons.trash />
                        </button>
                    </div>
                </div>

                @if ($category->children && $category->children->isNotEmpty())
                    <div x-show="open">
                        <x-sb.catalog.cp.categories.child :categories="$category->children" />
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="flex items-center gap-4">
        <a href="{{route()}}" class="p-2 bg-accent-primary rounded-full hover:bg-accent-secondary transition-colors duration-300" title="Add Category">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
        </a>
    </div>
</div>

