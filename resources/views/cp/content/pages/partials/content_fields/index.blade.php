@isset($contents)
    @foreach($contents as $content)
        <h5 class="text-text-secondary mb-4">{{ $content->title }}</h5>
        <input type="hidden" name="content[{{ $loop->index }}][key]" value="{{ $content->key }}">
        <input type="hidden" name="content[{{ $loop->index }}][type]" value="{{ $content->type }}">

        <div class="flex flex-col gap-3 p-1">
            @isset($content->entries)
                <x-cp.content-fields
                    :fields="$content->entries"
                    :parent-id="$content->id"
                    data-name="content[{{ $loop->index }}][data]"
                />
            @endisset

            @if($content->panels->count() > 0)
                <x-cp.panels.container
                    :panels="$content->panels"
                    :loop="$loop"
                />
            @endif
        </div>
    @endforeach
@endisset
