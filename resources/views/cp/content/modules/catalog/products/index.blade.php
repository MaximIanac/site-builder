@extends('layouts.cp.app')

@section('title', "Product")

@section('content')
    <div class="min-h-screen space-y-8">
        <x-sb.catalog.cp.products.header />

        <x-sb.catalog.cp.products.list
            :products="$products->items()"
        />
    </div>
@endsection
