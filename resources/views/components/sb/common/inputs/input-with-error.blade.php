@props([
    'label',
    'name',
    'id' => null,
    'value' => null,
])

@php
    $id = $id ?? $name;
@endphp

<div>
    <div class="flex gap-2 items-center">
        <x-input-label :for="$id">{{ $label }}</x-input-label>
        @error($name)
            <x-sb.common.inputs.error :messages="$message" />
        @enderror
    </div>

    <x-inputs.text :id="$id" :name="$name" :value="old($name, $value)" />
</div>
