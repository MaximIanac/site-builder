@extends('layouts.cp.app')

@section('title', "Product")

@section('content')
    <div class="space-y-8">
        <!-- Product Header -->
        <div class="flex justify-between items-center">
            <div class="flex gap-2 items-end">
                <h1 class="text-xl">{{ $product->name }}</h1>
                <a href="{{ route('cp.content.modules.catalog.categories.show', $product->category->slug) }}" class="inline-flex">
                    <span class="text-text-secondary text-sm bg-gray-700/50 px-1.5 py-0.5 rounded-full lowercase" >{{ $product->category->name }}</span>
                </a>
            </div>
            <div class="self-end space-x-2">
                <x-sb.common.badges.default class="!max-w-none">SLUG: {{ $product->slug }}</x-sb.common.badges.default>
                <x-sb.common.badges.default class="!max-w-none">ID: {{ $product->id }}</x-sb.common.badges.default>
            </div>
        </div>

        {{--  //TODO: Добавить работу с картинками, валютами, переводами --}}

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Image Gallery -->
            <div class="space-y-4">
{{--                @php--}}
{{--                    $mainImage = $product->media->firstWhere('meta.is_main', true);--}}
{{--                    $otherImages = $product->media->where('meta.is_main', false)->sortBy('meta.sort_order');--}}
{{--                @endphp--}}

                <div class="bg-gray-800 rounded-xl overflow-hidden min-h-[300px]">
                    <img src="{{ $product->thumbnail?->getUrl() ?? "https://placehold.co/800x600/1f2937/ffffff?text=$product->name" }}"
                         alt="{{ $product->name }}"
                         class="w-full h-auto object-cover">
                </div>

{{--                @dd($product->images)--}}

                @if($product->images->count() > 0)
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($product->images->filter(fn($item) => $item->uuid !== $product?->thumbnail?->uuid)  as $image)
                            <div class="bg-gray-800 rounded-lg overflow-hidden cursor-pointer h-[150px]">
                                <img
                                    src="{{ $image->getUrl() ?? "https://placehold.co/200x150/1f2937/ffffff?text=$product->name" }}"
                                    alt="{{ $product->name . $loop->index . 'miniImage' }}"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Details -->
            <div class="space-y-6">
                <x-sb.common.buttons.link href="{{route('cp.content.modules.catalog.products.edit', $product->slug)}}" class="w-full justify-center">
                    Edit
                </x-sb.common.buttons.link>

                <x-sb.common.wrappers.cp-default>
                    <h2 class="text-lg mb-2">Overview</h2>
                    <p class="text-text-secondary">
                        {{ $product->short_description }}
                    </p>
                </x-sb.common.wrappers.cp-default>

                <!-- Offers -->
                <x-sb.common.wrappers.cp-default>
                    <h2 class="text-lg mb-2">Offers</h2>
                    <div class="space-y-3">
                        @foreach($product->offers as $offer)
                            <div class="flex justify-between items-center p-4 dark:bg-gray-700 bg-gray-200 rounded-lg">
                                <div>
                                    <p class="text-sm text-text-primary font-semibold">SKU: {{$offer->sku}}</p>
                                    @foreach($offer->propertyValues as $property)
                                        <p class="text-sm text-gray-400">{{$property->property->name}}: {{$property->value}}</p>
                                    @endforeach
                                </div>
                                <div class="text-right self-start">
                                    @if($offer->prices->count() > 0)
                                        <p class="text-base font-bold">{{$offer->prices[0]->currency->value}} {{$offer->prices[0]->value}}</p>
                                    @endif

                                    <p class="text-xs text-green-500 uppercase font-mono">In Stock: {{$offer->quantity}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-sb.common.wrappers.cp-default>

                <!-- Properties -->
                <x-sb.common.wrappers.cp-default>
                    <h2 class="text-lg mb-2">Specifications</h2>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($product->propertyValues as $propertyValue)
                            <div>
                                <p class="text-gray-400 text-sm">{{ $propertyValue->property->name }}</p>
                                <p class="text-sm font-medium">{{ $propertyValue->value }}</p>
                            </div>
                        @endforeach
                    </div>
                </x-sb.common.wrappers.cp-default>
            </div>
        </div>

        <!-- Full Description -->
        <x-sb.common.wrappers.cp-default class="mt-8">
            <h2 class="text-lg mb-2">Description</h2>
            <div class="prose prose-invert max-w-none">
                <p>{{ $product->description }}</p>
            </div>
        </x-sb.common.wrappers.cp-default>
    </div>
@endsection
