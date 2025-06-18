@extends('layouts.cp.app')

@section('title', 'Edit Page')

@section('content')

    <div class="mx-auto">
        <form action="{{ route('cp.content.pages.update', $page) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-text-primary">{{ $page->title }}</h3>

                <x-buttons.button-base type="submit">Edit Page</x-buttons.button-base>
            </div>

            <div class="grid grid-cols-[3fr_1fr] gap-8">
                <div class="bg-bg-secondary shadow rounded-lg py-6 px-4">
                    @include('cp.content.pages.partials.content_fields.index')
                </div>

                <div class="bg-bg-secondary shadow rounded-lg py-6 px-4">
                    @include('cp.content.pages.partials.page-fields')
                </div>
            </div>
        </form>
    </div>

@endsection
