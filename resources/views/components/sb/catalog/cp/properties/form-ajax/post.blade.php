@props([
    'label' => 'Property',
    'usageType' => 'category',
    'showMini' => false
])

<div x-data="propertyManager()" class="p-4 flex flex-col gap-4">
    {{ $label }}

    @if(!$showMini)
{{--        <hr class="border-gray-700">--}}
    @endif

    <div class="flex flex-col gap-4">
        <div class="relative">
            <div class="flex border-b border-gray-200 dark:border-gray-700">
                @foreach(site_locales() as $locale)
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
            <div class="mt-4">
                <template x-for="locale in locales" :key="locale">
                    <div
                        x-show="activeLocale === locale"
                        x-cloak
                    >
                        <x-sb.common.inputs.label for="property-name">Name (<span x-text="locale"></span>)</x-sb.common.inputs.label>
                        <span class="text-sm text-red-500 font-semibold" x-text="errors.name?.[locale]"></span>
                        <x-sb.common.inputs.text id="property-name" x-model="payload.name[locale]"/>
                    </div>
                </template>
            </div>
        </div>

        <div x-show="errors.code">
            <x-sb.common.inputs.label for="property-code">Code</x-sb.common.inputs.label>
            <span class="text-sm text-red-500 font-semibold" x-text="errors.code?.[0]"></span>
            <x-sb.common.inputs.text id="property-code" x-model="payload.code" class="text-gray-500 dark:text-gray-600 font-mono" placeholder="Auto-generated from name"/>
        </div>
    </div>

    <div class="flex justify-between gap-8">
        <div class="flex-1">
            <x-sb.common.inputs.label for="property-type">Type</x-sb.common.inputs.label>
            <x-sb.common.select.default class="w-full" id="property-type" x-model="payload.type">
                <option value="string">String</option>
                <option value="integer">Integer</option>
                <option value="boolean">Boolean</option>
                <option value="float">Float</option>
                <option value="text">Text</option>
            </x-sb.common.select.default>
        </div>
    </div>

    <div class="flex justify-between gap-8">
        @if(!$showMini)
            <x-secondary-button type="button" x-on:click="$dispatch('close')">
                Close
            </x-secondary-button>
        @endif

        <x-sb.common.buttons.default type="button" x-on:click="createProperty()" class="!text-[12px] !py-2 !px-3 {{ $showMini ? 'w-full' : ''}}">
            <span x-show="!loading">Create</span>
            <span x-show="loading" class="flex items-center justify-center">
                <x-sb.common.icons.spinner />
                Processing...
            </span>
        </x-sb.common.buttons.default>
    </div>
</div>

<script>
    function propertyManager() {
        return {
            errors: {},
            locales: @json(site_locales()),
            payload: {
                name: {},
                code: null,
                type: '',
                usage_type: @json($usageType),
            },
            loading: false,
            activeLocale: @json(app()->getLocale() ?? site_locales()[0] ?? 'en'),

            init() {
                this.payload.name = Object.fromEntries(
                    this.locales.map(locale => [locale, ''])
                );
            },

            async createProperty() {
                if (this.loading) return;

                this.loading = true;

                const ajax = useAjax();

                await ajax.post(
                    "{{ route('api.cp.content.modules.catalog.properties.store') }}",
                    this.payload
                );

                if (ajax.state.error) {
                    this.errors = ajax.state.error;
                    this.payload.code = this.errors.code[1];
                    console.log(this.errors)
                }

                if (ajax.state.data) {
                    this.errors = {}
                    this.$dispatch('property:created', ajax.state.data);
                    this.resetForm();
                }

                if (this.payload.usage_type === 'category') {
                    this.$dispatch('close');
                }

                this.loading = false;
            },

            resetForm() {
                this.payload = {
                    name: {},
                    type: 'string',
                };
                this.errors = {};
            }
        }
    }
</script>
