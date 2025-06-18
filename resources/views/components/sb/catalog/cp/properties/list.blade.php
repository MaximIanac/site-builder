@props([
    'properties' => [],
])

<style>
    .invisible-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: rgba(100, 100, 100, 0.3) transparent;
    }
</style>

<div class="flex flex-wrap gap-1 rounded-lg max-h-[500px] overflow-y-auto invisible-scrollbar">
    @foreach ($properties as $property)
        <x-sb.common.badges.default>
            <span class="truncate" title="{{ $property->name }} ({{ $property->code }}) - {{ $property->type }}">
                @if ($property->is_required)
                    <span class="text-red-400">*</span>
                @endif
                <span class="lowercase">{{ $property->name }}</span>
                <span class="text-gray-400/70 text-[9px] font-mono">({{ $property->type }})</span>
            </span>
        </x-sb.common.badges.default>
    @endforeach
</div>
