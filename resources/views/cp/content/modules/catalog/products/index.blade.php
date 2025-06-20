@extends('layouts.cp.app')

@section('title', "Product")

@section('content')
    <div class="min-h-screen space-y-8">
            <!-- Product Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-xl">MacBook Pro 16" M2 Max</h1>
            <div class="self-end">
                <span class="bg-indigo-600 text-white px-3 py-1 rounded-full text-sm">SLUG: maxbook</span>
                <span class="bg-indigo-600 text-white px-3 py-1 rounded-full text-sm">ID: 1234</span>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Image Gallery -->
            <div class="space-y-4">
                <div class="bg-gray-800 rounded-xl overflow-hidden">
                    <img src="https://placehold.co/800x600/1f2937/ffffff?text=MacBook+Pro"
                         alt="Product Main Image"
                         class="w-full h-auto object-cover">
                </div>
                <div class="grid grid-cols-4 gap-2">
                    <div class="bg-gray-800 rounded-lg overflow-hidden cursor-pointer">
                        <img src="https://placehold.co/200x150/1f2937/ffffff?text=1"
                             alt="Product Image 1"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="bg-gray-800 rounded-lg overflow-hidden cursor-pointer">
                        <img src="https://placehold.co/200x150/1f2937/ffffff?text=2"
                             alt="Product Image 2"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="bg-gray-800 rounded-lg overflow-hidden cursor-pointer">
                        <img src="https://placehold.co/200x150/1f2937/ffffff?text=3"
                             alt="Product Image 3"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="bg-gray-800 rounded-lg overflow-hidden cursor-pointer">
                        <img src="https://placehold.co/200x150/1f2937/ffffff?text=4"
                             alt="Product Image 4"
                             class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="space-y-6">
                <x-sb.common.wrappers.cp-default>
                    <h2 class="text-lg mb-3">Overview</h2>
                    <p class="text-text-secondary">
                        The most powerful MacBook Pro ever is here. With the blazing-fast M2 Pro or M2 Max chip,
                        you'll get incredible performance and amazing battery life.
                    </p>
                </x-sb.common.wrappers.cp-default>

                <!-- Offers -->
                <x-sb.common.wrappers.cp-default>
                    <h2 class="text-lg mb-4">Offers</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-4 dark:bg-gray-700 bg-gray-200 rounded-lg">
                            <div>
                                <p class="text-sm text-gray-400">SKU: MBP16-M2-001</p>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold">$2,499.00</p>
                                <p class="text-sm text-green-400">In Stock: 15</p>
                            </div>
                        </div>
                    </div>
                </x-sb.common.wrappers.cp-default>

                <!-- Properties -->
                <x-sb.common.wrappers.cp-default>
                    <h2 class="text-lg mb-4">Specifications</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-400 text-sm">Processor</p>
                            <p class="text-sm font-medium">M2 Max 12-Core</p>
                        </div>
                    </div>
                </x-sb.common.wrappers.cp-default>
            </div>
        </div>

        <!-- Full Description -->
        <x-sb.common.wrappers.cp-default class="mt-8">
            <h2 class="text-lg mb-4">Description</h2>
            <div class="prose prose-invert max-w-none">
                <p>The MacBook Pro 16" with M2 Max chip delivers exceptional performance for professionals.
                    The 16.2-inch Liquid Retina XDR display features extreme dynamic range, 1,000 nits of sustained brightness,
                    and ProMotion technology for adaptive refresh rates up to 120Hz.</p>
            </div>
        </x-sb.common.wrappers.cp-default>
    </div>
@endsection
