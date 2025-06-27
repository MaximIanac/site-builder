@props([
    'product' => null,
    'offer_properties' => [],
    'categories' => [],
])

@dump($product)

@php
    $productImages = $product?->images->map(function($m) {
         return [
             'id' => $m->id,
             'preview' => $m->getUrl(),
             'main' => $m->getCustomProperty('main', false),
             'file' => ['name' => $m->file_name]
         ];
    });
@endphp

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <!-- Basic Information -->
        <x-sb.common.wrappers.cp-default>
            <h4 class="text-base">Base Information</h4>
            <hr class="my-4 border-gray-300/50 dark:border-gray-600/50">

            <div class="space-y-4">
                <x-sb.common.inputs.input-with-error label="Name" name="name" value="{{ $product->name ?? '' }}" />
                <x-sb.common.inputs.input-with-error label="Slug" name="slug" value="{{ $product->slug ?? '' }}" />

                <div class="mt-4">
                    <div class="flex gap-2 items-center">
                        <x-input-label for="short_description">Short Description</x-input-label>
                        @error('short_description')
                        <x-sb.common.inputs.error :messages="$message" />
                        @enderror
                    </div>
                    <textarea
                        id="short_description"
                        name="short_description"
                        rows="2"
                        class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 border rounded-md text-white focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none transition"
                    >{{ $product->short_description ?? '' }}</textarea>
                </div>

                <div class="mt-4">
                    <div class="flex gap-2 items-center">
                        <x-input-label for="description">Full Description</x-input-label>
                        @error('description')
                        <x-sb.common.inputs.error :messages="$message" />
                        @enderror
                    </div>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="w-full px-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 border rounded-md text-white focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none transition"
                    >{{ $product->description ?? '' }}</textarea>
                </div>
            </div>
        </x-sb.common.wrappers.cp-default>

        <!-- Media Gallery -->
        <x-sb.common.wrappers.cp-default>
            <x-slot:header>Media</x-slot:header>

            <div x-data="multipleFilesManager()">
                <input type="file" multiple class="hidden" x-ref="mediaFileInput" name="media[]" />

                <x-files.uploader
                    @multiple:file-added="addFile($event.detail)"
                    multiple
                />

                <!-- Image Previews -->
                <div class="grid grid-cols-4 gap-3 mt-4">
                    <template x-for="fileData in mediaImages" :key="fileData.id">
                        <div class="relative group max-w-[150px] max-h-[150px]" @click="setMain(fileData.id)">
                            <img
                                :src="fileData.preview"
                                alt="Preview"
                                class="rounded-lg border-2 shadow-xl w-full h-full object-cover"
                                :class="{
                                            'border-indigo-600': fileData.main,
                                            'dark:border-gray-700 border-gray-300': !fileData.main
                                        }"
                                x-show="fileData.preview"
                            >
                            <div x-show="fileData.main" class="absolute top-0 left-0 bg-indigo-600 text-white text-xs px-2 py-1 rounded">Main</div>
                            <button
                                @click="removeFile(fileData.id)"
                                class="absolute top-2 right-2 bg-gray-900 bg-opacity-70 rounded-full p-1 opacity-0 group-hover:opacity-100 transition"
                                type="button"
                                aria-label="Remove file"
                            >
                                <x-sb.common.icons.trash/>
                            </button>
                        </div>
                    </template>
                </div>

                <input type="hidden" name="media_meta" :value="mediaImagesMeta">
            </div>
        </x-sb.common.wrappers.cp-default>

        <!-- Product Offers -->
        <x-sb.catalog.cp.products.partials.product-offers-form-block
            :properties="$offer_properties"
        />
    </div>

    <!-- Right Column -->
    <div x-data="productPropertyManager()" class="space-y-6">
        <!-- Category -->
        <x-sb.common.wrappers.cp-default>
            <x-slot:header>Category</x-slot:header>

            <x-input-label for="category_id">Product category</x-input-label>
            <x-sb.common.inputs.error :messages="$errors->get('category_id')"/>

            <x-select.default name="category_id" class="w-full" x-model="selectedCategory" @change="fetchProperties">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </x-select.default>

            <a href="{{ route('cp.content.modules.catalog.categories.create') }}" class="inline-flex mt-2">
                <x-sb.common.buttons.add>Create category</x-sb.common.buttons.add>
            </a>
        </x-sb.common.wrappers.cp-default>

        <!-- Category Product Properties -->
        <x-sb.common.wrappers.cp-default>
            <x-slot:header>Category properties</x-slot:header>
            <div class="space-y-3">
                <div x-show="properties.length < 1 && !loading" class="h-20 flex items-center justify-center text-base">
                    <x-sb.common.placeholders.empty message="Select category"/>
                </div>

                <div x-show="loading" x-cloak class="h-20 flex items-center justify-center text-indigo-600">
                    <x-sb.common.icons.spinner class="w-6 h-6"/>
                </div>

                <template x-for="property in properties" :key="property.id">
                    <div>
                        <label
                            for="`properties[${property.id}]`"
                            class="block font-medium text-sm text-gray-700 dark:text-gray-300"
                            x-text="property.name">
                        </label>
                        <input
                            type="text"
                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-2 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm transition"
                            :name="`properties[${property.id}]`"
                            x-model="property.value"
                        >
                    </div>
                </template>
            </div>
        </x-sb.common.wrappers.cp-default>
    </div>
</div>

@push('scripts')
    <script>
        function productPropertyManager() {
            return {
                selectedCategory: @json(old('category_id', $product?->category->id ?? '')),
                properties: @json(old('properties', [])),
                loading: false,

                async init() {
                    if (!this.selectedCategory) return;

                    await this.fetchProperties();
                },

                async fetchProperties() {
                    this.properties = [];
                    this.loading = true;
                    const ajax = useAjax();

                    await ajax.get(
                        "{{ route('api.cp.content.modules.catalog.categories.parentProperties') }}",
                        {category: this.selectedCategory}
                    );

                    this.properties = ajax.state.data.properties

                    @if(!$product) this.setOldValues(@json(old('properties', [])));
                    @else this.setPropertyValues(@json($product->propertyValues));
                    @endif

                    this.loading = false

                    this.$dispatch('category:selected', this.properties)
                },

                setOldValues(oldValues) {
                    this.properties = this.properties.map(item => {
                        return {
                            ...item,
                            value: oldValues[item.id] ?? ''
                        };
                    });
                },

                setPropertyValues(propertyValues) {
                    this.properties = this.properties.map(item => {
                        const match = propertyValues.find(v => v.property.id === item.id);

                        return {
                            ...item,
                            value: match ? match.value : ''
                        };
                    });
                }
            }
        }
        function multipleFilesManager() {
            return {
                mediaImages: @json($productImages),

                setMain(id) {
                    this.mediaImages = this.mediaImages.map(item => ({
                        ...item,
                        main: item.id === id,
                    }));
                },

                addFile(fileData) {
                    this.mediaImages.push(fileData);
                    this.refreshFileInput();
                },

                removeFile(id) {
                    this.mediaImages = this.mediaImages.filter(item => item.id !== id);
                    this.refreshFileInput();
                },

                refreshFileInput() {
                    const dataTransfer = new DataTransfer();

                    this.mediaImages.forEach(item => dataTransfer.items.add(item.file));

                    if (this.$refs.mediaFileInput) this.$refs.mediaFileInput.files = dataTransfer.files;
                },

                get mediaImagesMeta() {
                    return JSON.stringify(
                        this.mediaImages.map(img => ({
                            [img.file.name]: { main: img.main }
                        }))
                    );
                }
            }
        }
    </script>
@endpush
