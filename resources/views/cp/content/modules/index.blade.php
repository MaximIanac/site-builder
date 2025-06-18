@extends('layouts.cp.app')

@section('title', 'Modules')

@section('content')
    @if($modules->isEmpty())
        <div class="p-6 bg-bg-secondary rounded-lg text-center shadow-sm transition-all duration-300">
            <p class="text-text-secondary text-sm mb-4">
                No modules available.
            </p>
        </div>
    @else
        <div class="grid grid-cols-[repeat(auto-fit,minmax(350px,1fr))] gap-8">
            @foreach($modules as $module)
                <a href="{{ route('cp.content.modules.show', $module->name) }}"
                   class="p-4 bg-bg-secondary rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 ease-out group overflow-hidden"
                >
                    <h3 class="font-bold text-text-primary group-hover:text-accent-primary uppercase">{{ $module->name }}</h3>
                    <hr class="w-36 my-6 border">
                    <p class="text-base text-text-secondary group-hover:text-accent-secondary line-clamp-3">{{ $module->description ?? 'No description' }}</p>

                    <div class="flex justify-between items-center gap-2 mt-4">
                        <span class="px-2 py-0.5 text-xs font-medium rounded-full {{ $module->is_installed ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                            {{ $module->is_installed ? 'Installed' : 'Not Installed' }}
                        </span>
                        @if(!$module->is_installed)
                            <form action="{{ route('cp.content.modules.install', $module) }}" method="POST" class="flex items-center">
                                @method('put')
                                @csrf
                                <button type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 stroke-text-secondary hover:stroke-accent-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    @endif
@endsection
