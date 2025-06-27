@props(['product' => []])

<div class="grid grid-cols-[1fr,100px] gap-8 mb-2 items-center text-sm text-text-primary group">
    <a href="{{ route('cp.content.modules.catalog.products.show', $product->slug) }}">
        <div class="grid grid-cols-[44px_minmax(150px,3fr)_minmax(200px,7fr)_minmax(120px,2fr)] rounded-xl p-2 bg-bg-secondary items-center hover:bg-gradient-to-r from-blue-600/5 to-blue-500/5 transition-all duration-300">
            <div>
                <img src="{{ $product->thumbnail ? $product->thumbnail->getUrl() : '' }}" alt="{{ $product->name }}" class="w-8 h-8 object-cover rounded-full border border-b-secondary shadow-sm">
            </div>
            <div class="font-medium">{{ $product->name }}</div>
            <div class="truncate">{{ $product->description }}</div>
            <div class="text-text-secondary">{{ $product->category->name }}</div>
        </div>
    </a>

    <div class="flex items-center justify-between gap-2">
        <x-sb.catalog.cp.products.item-offer-list
            :offers="$product->offers"
            :propertyValues="$product->propertyValues"
        />

        <div class="flex gap-2">
            <a href="{{ route('cp.content.modules.catalog.products.edit', $product->slug) }}" class="p-2 bg-bg-secondary rounded-full hover:scale-110 transition-transform duration-200" title="Edit {{ $product->name }}">
                <x-sb.common.icons.edit class="w-6 h-6 text-accent-primary" />
            </a>
        </div>
    </div>
</div>
