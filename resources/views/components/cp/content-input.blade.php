@props([
    'entity' => \Maximianac\SiteBuilder\Data\Content\EntriesData::class|\Maximianac\SiteBuilder\Data\Content\PanelFieldsData::class,
    'dataName',
    'loop',
])

<div
    x-data="translationManager()"
    x-init="translations = {{ json_encode($entity->translations->toArray()) }}"
    class="translations-container"
>
    <!-- Перебор переводов для отображения формы ввода -->
    <template x-for="(translation, index) in translations" :key="index">
        <div class="flex gap-2 mb-2">
            <x-text-input
                class="w-full text-sm px-3 py-0"
                x-model="translation.value"
            />
            <x-select.default
                :options="[
                    ['value' => 'en', 'label' => 'EN'],
                    ['value' => 'ru', 'label' => 'RU'],
                ]"
                x-model="translation.lang"
            />
            <button type="button" @click="removeTranslation(index)" class="p-2 text-red-500 hover:text-red-700 transition-colors">
                <x-icons.trash />
            </button>
        </div>
    </template>

    <!-- Скрытое поле для отправки сериализованных переводов -->
    <input type="hidden" name="{{$dataName}}[{{$loop->index}}][translations]" x-model="formattedTranslations">

    <x-secondary-button
        type="button"
        class="text-xs border-dashed dark:bg-transparent"
        @click="addTranslation()"
    >
        Add translation
    </x-secondary-button>
</div>

@push('scripts')
    <script>
        function translationManager() {

            return {
                translations: [],

                addTranslation() {
                    this.translations.push({ value: '', lang: '' })
                },
                removeTranslation(index) {
                    this.translations.splice(index, 1)
                },
                get formattedTranslations() {
                    return JSON.stringify(this.translations)
                }
            }
        }
    </script>
@endpush
