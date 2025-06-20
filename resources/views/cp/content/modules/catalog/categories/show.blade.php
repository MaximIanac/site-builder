@extends('layouts.cp.app')

@section('title', "Category - $category->name")

@section('content')
    <div>
        <!-- Header Card -->
        <x-sb.common.wrappers.cp-default class="mb-8">
            <div class="flex justify-between items-center">
                <h3 class="text-xl text-text-primary">{{ $category->name }}</h3>
                <div class="flex space-x-2 items-center">
                    <x-sb.common.buttons.link class="!px-4 !py-2" href="{{ route('cp.content.modules.catalog.categories.edit', $category) }}">
                        <x-sb.common.icons.edit class="w-6 h-6" />
                    </x-sb.common.buttons.link>
                    <form action="{{ route('cp.content.modules.catalog.categories.destroy', $category) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-sb.common.buttons.danger
                            onclick="return confirm('Are you sure?')"
                        >
                            Delete
                        </x-sb.common.buttons.danger>
                    </form>
                </div>
            </div>

            <hr class="border-b-secondary my-2">

            <div class="space-y-6">
                @if($category->description)
                    <div>
                        <h4 class="text-base mb-2">Description</h4>
                        <span class="text-text-secondary font-medium px-1">{{ $category->description }}</span>
                    </div>
                @endif

                @if($category->parent)
                    <div>
                        <h4 class="text-base mb-2">Parent Category</h4>
                        <x-sb.common.buttons.link
                            class="!block !px-2 !py-2"
                            href="{{ route('cp.content.modules.catalog.categories.show', $category->parent) }}"
                        >
                            {{ $category->parent->name }}
                        </x-sb.common.buttons.link>
                    </div>
                @endif


                @if($category->allChildren->count() > 0)
                    <div>
                        <h4 class="text-base mb-2">Subcategories</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($category->allChildren as $child)
                                <x-sb.common.buttons.link
                                    class="!block !px-2 !py-2 text-center"
                                    href="{{ route('cp.content.modules.catalog.categories.show', $child->slug) }}"
                                >
                                    {{ $child->name }}
                                </x-sb.common.buttons.link>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </x-sb.common.wrappers.cp-default>

        <!-- Properties and Products -->
        <div class="flex justify-between gap-8">
            <!-- Properties Card -->
            <x-sb.common.wrappers.cp-default class="min-w-[150px] w-1/5">
                <h4 class="text-base text-text-secondary">Category Properties</h4>

                <hr class="border-b-secondary my-2">

                <div class="flex flex-wrap gap-2">
                    @if($category->properties->count() > 0)
                        @foreach($category->properties as $property)
                            <x-sb.common.badges.default class="max-w-[200px] group">
                                <span class="truncate flex items-center">
                                    @if($property->is_required)
                                        <span class="text-red-400 mr-1">*</span>
                                    @endif
                                    <span class="font-medium">{{ $property->name }}</span>
                                    <span class="mx-1 text-gray-400">-</span>
                                    <span class="lowercase font-mono text-gray-400 text-xs">{{ $property->code }}</span>
                                    <span class="ml-1 text-gray-400/70 text-[9px] font-mono">({{ $property->type }})</span>
                                </span>
                            </x-sb.common.badges.default>
                        @endforeach
                    @else
                        <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded">
                            No properties assigned to this category
                        </div>
                    @endif
                </div>
            </x-sb.common.wrappers.cp-default>

            <!-- Products Card -->
            <div class="flex-1 space-y-2">
                <x-sb.common.wrappers.cp-default>
                    <div class="flex justify-between items-center">
                        <h4 class="text-base text-text-secondary">
                            Products ({{ $category->products->count() }})
                        </h4>
                        <a href="" class="inline-flex">
                            <x-sb.common.buttons.add class="!py-1">
                                Add Product
                            </x-sb.common.buttons.add>
                        </a>
                    </div>
                </x-sb.common.wrappers.cp-default>

                <x-sb.catalog.cp.products.list :products="$products" />
            </div>

        </div>
    </div>
@endsection
