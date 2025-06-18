@props(['segments' => []])

@if(count($segments) > 0)
    <nav aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2">
            @foreach($segments as $item)
                <li>
                    @if(!$item['active'])
                        <div class="flex items-center">
                            <a href="{{ $item['url'] }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">
                                {{ $item['title'] }}
                            </a>
                            <svg class="h-5 w-5 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    @else
                        <span class="text-sm font-medium text-gray-700" aria-current="page">
                            {{ $item['title'] }}
                        </span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif
