@extends('layouts.cp.app')

@section('title', 'Pages')

@section('content')

    <div class="flex justify-between items-center mb-6">
        <h3 class="text-text-primary">
            Pages
        </h3>

        <x-buttons.link href="{{ route('cp.content.pages.create') }}">Add New Page</x-buttons.link>
    </div>

    @if($pages->isEmpty())
        <div class="p-6 bg-bg-secondary rounded-lg text-center">
            <p class="text-text-secondary text-sm mb-4">
                No pages available.
            </p>
        </div>
    @else
        <div class="flex flex-col gap-2">
            @foreach($pages as $page)
                <a href="{{ route('cp.content.pages.edit', $page) }}">
                    <div class="flex items-center justify-between py-2 px-3 bg-bg-secondary shadow-md rounded-lg hover:shadow-lg transition">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-green-600 animate-pulse"></span>

                            <h6 class="text-text-primary mr-6">
                                {{ $page->title }}
                            </h6>

                            <p class="text-text-secondary font-mono">
                                {{ $page->slug ?? 'No slug available.' }}
                            </p>
                        </div>
                        <div class="text-sm uppercase font-mono text-text-secondary">
                            @if($page->slug === 'home')
                                <span>Main Page</span>
                            @else
                                <span>Page</span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

@endsection
