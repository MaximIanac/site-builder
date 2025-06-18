@use('\Maximianac\SiteBuilder\Utility\Enums\EntryType')
@use('\Maximianac\SiteBuilder\Utility\Enums\ContentType')
@props([
'fields' => [],                                      // Коллекция полей для отображения
    'parentId' => null,                              // ID родительского элемента
    'parentType' => ContentType::Default->value,     // ContentType родительского элемента
    'dataName' => '',
    'fieldKey' => 'key',
    'fieldType' => 'type',
    'fieldTitle' => 'title',
    'fieldValue' => 'value',
])

@foreach($fields as $field)
    <div class="mb-4">
        <label
            for="{{ $field->$fieldKey }}"
            class="block text-sm font-medium text-text-secondary"
        >
            {{ $field->$fieldTitle ?? ucfirst($field->$fieldKey) }}
        </label>

        {{-- Hidden fields for key and type --}}
        <input
            type="hidden"
            name="{{ $dataName }}[{{ $loop->index }}][{{ $fieldKey }}]"
            value="{{ $field->$fieldKey }}"
        />
        <input
            type="hidden"
            name="{{ $dataName }}[{{ $loop->index }}][{{ $fieldType }}]"
            value="{{ $field->$fieldType }}"
        />

        {{-- Dynamic field rendering based on type --}}
        @switch($field->$fieldType)
            @case(EntryType::File)
                <x-files.uploader
                    class="w-64 text-sm"
                    name="{{ $field->$fieldKey }}_{{ $parentType }}_{{ $parentId }}"
                    :value="$field->$fieldValue ?? $field->translations->first()?->$fieldValue ?? null"
                    accept=".svg,.png,.jpg,.jpeg,.gif"
                    hint="SVG, PNG, JPG, or GIF (Max 800x400px)"
                />
                @break

            @default
                <x-cp.content-input
                    :entity="$field"
                    :loop="$loop"
                    :data-name="$dataName"
                />

        @endswitch

        {{-- Validation error --}}
        @error($dataName . '.data.' . $loop->index . '.' . $fieldValue)
            <span class="text-red-500 text-xs">{{ $message }}</span>
        @enderror
    </div>
@endforeach
