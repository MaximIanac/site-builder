@extends('layouts.cp.app')

@section('title', 'Create Page')

@section('content')

    <div class="mx-auto">
        <form action="{{ route('cp.content.pages.store') }}" method="POST">
            @csrf

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-text-primary">Create New Page</h3>

                <x-buttons.button-base type="submit">Add Page</x-buttons.button-base>
            </div>

            <div class="grid grid-cols-[3fr_1fr] gap-8">
                <div class="bg-bg-secondary shadow rounded-lg py-6 px-4">
                    test
                </div>

                <div class="bg-bg-secondary shadow rounded-lg py-6 px-4">
                    @include('cp.content.pages.partials.page-fields', ['templates' => $templates])
                </div>
            </div>
        </form>
    </div>

@endsection
