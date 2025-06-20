<div x-data="propertyManager()" class="p-4 flex flex-col gap-4">
    Property

    <hr class="border-gray-700">

    <div class="flex justify-between gap-8">
        <div class="flex-1">
            <x-sb.common.inputs.label for="property-name">Name</x-sb.common.inputs.label>
            <span class="text-sm text-red-500 font-semibold" x-text="errors.name"></span>
            <x-sb.common.inputs.text id="property-name" x-model="payload.name"/>
        </div>

        <div class="flex-1">
            <x-sb.common.inputs.label for="property-code">Code</x-sb.common.inputs.label>
            <span class="text-sm text-red-500 font-semibold" x-text="errors.code"></span>
            <x-sb.common.inputs.text id="property-code" x-model="payload.code" class="text-gray-500 dark:text-gray-700 font-mono" placeholder="Auto-generated from name"/>
        </div>
    </div>

    <div class="flex justify-between gap-8 mb-4">
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

        <div class="flex-1">
            <x-sb.common.inputs.label for="property-required">Is required</x-sb.common.inputs.label>
            <x-sb.common.inputs.checkbox id="property-required" x-model="payload.is_required"/>
        </div>
    </div>

    <hr class="border-gray-700">

    <div class="flex justify-between gap-8">
        <x-secondary-button type="button" x-on:click="$dispatch('close')">
            Close
        </x-secondary-button>

        <x-sb.common.buttons.default type="button" x-on:click="createProperty()">
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
            payload: {
                name: '',
                code: '',
                type: 'string',
                is_required: false,
            },
            loading: false,

            init() {
                this.$watch('payload.name', value => {
                    const isValid = /^[A-Za-z0-9\s\-]*$/.test(value);
                    if (!isValid) {
                        this.payload.name = value.replace(/[^A-Za-z0-9\s\-]/g, '');
                    }

                    this.payload.code = this.slugify(value);
                });
            },

            validate() {
                this.errors = {};
                let isValid = true;

                if (!this.payload.name.trim()) {
                    this.errors.name = 'Name is required';
                    isValid = false;
                }

                if (!this.payload.code.trim()) {
                    this.errors.code = 'Code is required';
                    isValid = false;
                }

                if (!this.payload.type) {
                    this.errors.type = 'Type is required';
                    isValid = false;
                }

                return isValid;
            },

            slugify(value) {
                return value
                    .toString()
                    .normalize('NFD')
                    .replace(/[\u0300-\u036f]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+/, '')
                    .replace(/-+$/, '')
                    .toLowerCase();
            },

            async createProperty() {
                if (this.loading) return;

                if (!this.validate()) {
                    return;
                }

                this.loading = true;

                const ajax = useAjax();

                await ajax.post(
                    "{{ route('api.cp.content.modules.catalog.properties.store') }}",
                    this.payload
                );

                if (ajax.state.error) {
                    this.errors = ajax.state.error;
                }

                if (ajax.state.data) {
                    this.errors = {}
                    this.$dispatch('property-created', ajax.state.data.data);
                    this.$dispatch('close');
                    this.resetForm();
                }

                this.loading = false;
            },

            resetForm() {
                this.payload = {
                    name: '',
                    code: '',
                    type: 'string',
                    is_required: false,
                };
                this.errors = {};
            }
        }
    }
</script>
