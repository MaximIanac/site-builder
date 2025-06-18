@props([
    'products' => [],
])

<div>
    <div class="grid grid-cols-[1fr,100px] gap-8 items-center bg-bg-primary text-sm font-semibold text-text-primary">
        <div class="grid grid-cols-[44px_minmax(150px,3fr)_minmax(200px,7fr)_minmax(120px,2fr)] items-center p-2">
            <div></div>
            <div>Name</div>
            <div>Description</div>
            <div>Category</div>
        </div>
        <div class="py-4">Details</div>
    </div>

    @foreach($products as $product)
        <x-sb.catalog.cp.products.item :product="$product" />
    @endforeach

    <div class="mt-6">
        {{ ($products->links()) }}
    </div>
</div>
