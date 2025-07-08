@props([
    'label',
    'name',
    'id' => null,
    'value' => null,
    'placeholder' => '',
    'type' => 'text',
    'size' => 'md',
])

@php
    $id = $id ?? $name;

    $size = [
        'xs' => '!px-1 !py-1 !text-xs',
        'sm' => '!px-2 !py-1.5 !text-sm',
        'md' => '',
    ][$size];
@endphp

<div>
    <div class="flex gap-2 items-center">
        <x-sb.common.inputs.label :for="$id">{{ $label }}</x-sb.common.inputs.label>
        @error($name)
            <x-sb.common.inputs.error :messages="$message" />
        @enderror
    </div>

    <x-sb.common.inputs.text
        :id="$id"
        :name="$name"
        :value="old($name, $value)"
        type="{{ $type }}"
        placeholder="{{ $placeholder }}"
        class="{{$size}}"
    />
</div>
