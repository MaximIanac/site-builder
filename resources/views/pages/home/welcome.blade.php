@extends('layouts.default.app')

@section('title', $page->title)

@section('content')

    <div class="py-12">
        <x-content-block
            :pageId="$page->id"
            key="main_slogan"
            :entryKeys="[
                'slogan',
                ['type' => 'file', 'key' => 'image']
            ]"
        >
            @aware(['BLOCK'])

            <div class="flex flex-col md:flex-row items-center justify-between bg-gradient-to-r from-indigo-500 to-indigo-600 rounded-lg shadow-2xl p-8">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 md:mb-0 md:mr-8">
                    {{ $BLOCK->getValue('slogan') }}
                </h1>
                <img
                    src="{{ $BLOCK->getValue('image') }}"
                    alt="Productivity Illustration"
                    class="w-full md:w-1/2 lg:w-1/3 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300"
                />
            </div>
        </x-content-block>


        <x-content-block
            :pageId="$page->id"
            key="main_panel"
            type="panel"
            :entryKeys="[
                'title',
                'desc',
                ['type' => 'file', 'key' => 'main_image'],
            ]"
        >
            @aware(['BLOCK'])

            <div class="container mx-auto px-6 py-12 max-w-7xl">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($BLOCK->getPanels() as $panel)
                        <div class="group bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300">
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $panel->getValue('main_image') }}"
                                     alt="{{ $panel->getValue('title') }}"
                                     class="w-full h-full object-cover transition-transform duration-500"
                                     loading="lazy"
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-70 group-hover:opacity-90 transition-opacity duration-300"></div>
                            </div>

                            <div class="p-6 space-y-4">
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors duration-300">
                                    {{ $panel->getValue('title') ?? 'No Title' }}
                                </h2>
                                <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3">
                                    {{ $panel->getValue('desc') }}
                                </p>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                        {{ $panel->getValue('category') ?? 'Category' }}
                                    </span>
                                    <a href="#"
                                       class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white rounded-full text-sm font-medium hover:bg-indigo-700 transform transition-all duration-300">
                                        Read More
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-content-block>
    </div>

@endsection
