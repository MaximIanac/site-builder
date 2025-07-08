<!-- resources/views/components/sb/common/panels/locale-fields.blade.php -->
@props([
    'locales' => site_locales(),
    'defaultLocale' => app()->getLocale() ?? site_locales()[0] ?? 'en',
    'fields' => [],
])

<div class="mb-8" x-data="{ activeLocale: '{{ $defaultLocale }}' }">
    <!-- Language selector -->
    <div class="relative">
        <div class="flex border-b border-gray-200 dark:border-gray-700">
            @foreach($locales as $locale)
                <button
                    type="button"
                    @click="activeLocale = '{{ $locale }}'"
                    class="relative px-4 py-3 text-sm font-medium transition-all duration-300 text-gray-500 dark:text-gray-400"
                    :class="{
                        'text-indigo-600 dark:text-indigo-400': activeLocale === '{{ $locale }}',
                        'hover:text-gray-700 dark:hover:text-gray-300': activeLocale !== '{{ $locale }}'
                    }"
                >
                    {{ strtoupper($locale) }}
                    <span
                        class="absolute inset-x-1 -bottom-px h-0.5 bg-indigo-500 transition-all duration-300"
                        x-cloak
                        :class="{
                            'scale-x-100': activeLocale === '{{ $locale }}',
                            'scale-x-0': activeLocale !== '{{ $locale }}'
                        }"
                    ></span>
                </button>
            @endforeach
        </div>
    </div>

    <!-- Fields container -->
    <div class="mt-4">
        @foreach($locales as $locale)
            <div
                x-show="activeLocale === '{{ $locale }}'"
                x-cloak
                class="space-y-4"
            >
                {{ $slot }}

                <!-- Dynamic field groups -->
                @foreach($fields as $group)
                    <div class="{{ $group['wrapperClass'] ?? '' }}">
                        @if($group['type'] === 'input')
                            <x-sb.common.inputs.input-with-error
                                :label="$group['label'].' ('.$locale.')'"
                                :name="$group['name'].'['.$locale.']'"
                                :value="$group['value']($locale) ?? ''"
                                :placeholder="$group['placeholder'] ?? ''"
                            />
                        @elseif($group['type'] === 'textarea')
                            <div class="space-y-2">
                                <x-sb.common.inputs.label :for="$group['name'].'_'.$locale">
                                    {{ $group['label'] }} ({{ $locale }})
                                </x-sb.common.inputs.label>
                                <textarea
                                    id="{{$group['name'].'_'.$locale }}"
                                    name="{{$group['name'].'['.$locale.']'}}"
                                    rows="{{ $group['rows'] ?? 3 }}"
                                    class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 border rounded-md focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none transition"
                                >{{ $group['value']($locale) ?? $group['placeholder'] ?? '' }}</textarea>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
