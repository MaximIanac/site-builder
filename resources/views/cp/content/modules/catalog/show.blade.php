@extends('layouts.cp.app')

@section('title', 'Catalog')

@section('content')
    <div class="mx-auto space-y-8">
        <x-sb.catalog.cp.categories.wrapper>
            <x-sb.catalog.cp.categories.list :categories="$data->categories" />
        </x-sb.catalog.cp.categories.wrapper>

        <div class="flex gap-8">
            <div class="flex-1">
                <x-sb.catalog.cp.products.wrapper>
                    <x-sb.catalog.cp.products.header />
                    <x-sb.catalog.cp.products.list :products="$data->products->items()" />
                </x-sb.catalog.cp.products.wrapper>
            </div>

            <div class="w-1/5">
                <x-sb.catalog.cp.properties.wrapper>
                    <x-sb.catalog.cp.properties.list :properties="$data->properties" />
                </x-sb.catalog.cp.properties.wrapper>
            </div>
        </div>
    </div>
@endsection
