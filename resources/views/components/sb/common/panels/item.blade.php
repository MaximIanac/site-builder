@use('\Maximianac\SiteBuilder\Utility\Enums\EntryType')
@use('\Maximianac\SiteBuilder\Utility\Enums\ContentType')
@props(['panel', 'dataName'])

<div
    x-data="{ open: false }"
    class="w-full bg-gray-800 border border-gray-700 rounded-md shadow-sm"
>
    <div class="flex items-center justify-between px-3 py-2 cursor-move draggable-handle">
        <div class="flex items-center gap-2">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10M7 11h10M7 15h10" />
            </svg>

            <template x-if="!open">
                <div class="flex items-center gap-2 text-sm text-gray-300">
                    <span class="font-semibold">Set</span>
                    @if($panel->short_view)
                        @foreach($panel->short_view as $index => $el)
                            @if($el->type === EntryType::File)
                                <img
                                    src="{{ asset($el->value) }}"
                                    alt="Field preview"
                                    class="w-8 h-5 object-cover rounded-sm"
                                />
                            @else
                                <span class="text-gray-400">{{ $el->value }}{{ !$loop->last ? ' · ' : '' }}</span>
                            @endif
                        @endforeach
                    @endif
                </div>
            </template>
        </div>

        <div class="flex items-center gap-1">
            <button
                type="button"
                @click="open = !open"
                class="p-1.5 text-gray-300 bg-gray-700 rounded hover:bg-gray-600"
                aria-label="Toggle expand/collapse"
            >
                <x-icons.arrow
                    x-bind:class="{ 'rotate-180': open }"
                    class="transition-transform duration-300"
                />
            </button>

            <button
                type="button"
                @click="$dispatch('delete-panel', {{$panel->id}})"
                class="p-1.5 text-gray-300 bg-red-700 rounded hover:bg-red-600"
                aria-label="Delete panel"
            >
                <x-icons.x-mark />
            </button>
        </div>
    </div>

    <div
        x-show="open"
        class="px-4 py-3 bg-gray-900"
    >
        <div class="space-y-3">
            <input
                type="hidden"
                name="{{$dataName}}[id]"
                value="{{ $panel->id }}"
            />
            <x-cp.content-fields
                :fields="$panel->fields"
                :parent-id="$panel->id"
                :parent-type="ContentType::Panel->value"
                data-name="{{$dataName}}[fields]"
            />
        </div>
    </div>
</div>
