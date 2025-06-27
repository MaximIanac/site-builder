@extends('layouts.cp.app')

@section('title', "Create Product")

@section('content')
    <x-sb.common.forms.default action="{{ route('cp.content.modules.catalog.products.store') }}" method="POST"  enctype="multipart/form-data">
        <!-- Header -->
        <div class="flex justify-end mb-8">
            <x-sb.common.buttons.default type="submit">Publish Product</x-sb.common.buttons.default>
        </div>

        <div class="min-h-screen pb-16">
            <!-- Main Form -->
            <x-sb.catalog.cp.products.form-templates.create-edit.default
                :offer_properties="$offer_properties"
                :categories="$categories"
            />
        </div>
    </x-sb.common.forms.default>
@endsection
