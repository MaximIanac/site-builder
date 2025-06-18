@extends('layouts.cp.app')

@section('title', 'Catalog - Category')

@section('content')
    <x-sb.common.forms.default action="{{ route('cp.content.modules.catalog.category.store') }}" method="POST">
        <div class="flex justify-end items-center mb-6">
            <x-buttons.button-base type="submit">Create Category</x-buttons.button-base>
        </div>

        <x-sb.catalog.cp.categories.form-templates.create-edit.default
            :categories="$categories"
            :properties="$properties"
        />
    </x-sb.common.forms.default>
@endsection
