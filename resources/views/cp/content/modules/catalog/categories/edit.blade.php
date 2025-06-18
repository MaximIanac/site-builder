@extends('layouts.cp.app')

@section('title', 'Catalog - Edit Category')

@section('content')
    <x-sb.common.forms.default
        action="{{ route('cp.content.modules.catalog.category.update', $category->slug) }}"
        method="POST"
    >
        @method('PUT')
        <div class="flex justify-end items-center mb-6">
            <x-buttons.button-base type="submit">Save Changes</x-buttons.button-base>
        </div>

        <x-sb.catalog.cp.categories.form-templates.create-edit.default
            :categories="$categories"
            :properties="$properties"
            :category="$category"
        />
    </x-sb.common.forms.default>
@endsection
