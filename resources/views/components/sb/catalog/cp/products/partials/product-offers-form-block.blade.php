@props([
    'variant' => [],
    'properties' => [],
])

<div
    x-data="offerManager()"
    @property:created.window="($event) => allProperties.push($event.detail)"
>
    <x-sb.common.wrappers.cp-default class="space-y-3" >
        <x-slot:header>Product Offers</x-slot:header>

        <div class="flex flex-wrap items-center gap-3">
            <x-sb.common.buttons.add x-on:click="$dispatch('open-modal', 'choose-offer-properties-modal')">
                Add properties
            </x-sb.common.buttons.add>

            <div x-show="chosenProperties.length > 0" class="flex-1">
                <div class="flex flex-wrap items-center gap-2">
                    <template x-for="property in chosenProperties.slice(0, 3)" :key="property.id">
                        <div @click="toggleProperty(property, false)" class="relative group cursor-pointer flex items-center gap-1 bg-gray-800/50 hover:bg-gray-700/70 rounded-full px-2.5 py-1 pr-6 text-xs transition-colors border border-gray-700/50">
                            <span x-show="property.is_required" class="text-red-400/80">*</span>
                            <span x-text="property.name" class="font-medium text-gray-200 truncate max-w-[100px]"></span>
                            <span class="text-gray-500/70 text-[10px] font-mono lowercase" x-text="property.code"></span>

                            <span class="absolute right-1.5 opacity-0 group-hover:opacity-100 transition-opacity text-gray-500 group-hover:text-red-400">
                                <x-sb.common.icons.x-mark class="w-2.5 h-2.5" />
                            </span>
                        </div>
                    </template>

                    <button
                        type="button" x-show="chosenProperties.length > 3"
                        @click="$dispatch('open-modal', 'choose-offer-properties-modal')"
                        class="text-xs text-indigo-400 hover:text-indigo-500 flex items-center gap-1 ml-1"
                    >
                        <span x-text="`+${chosenProperties.length - 3} more`"></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Offers -->
        <template x-for="(offer, index) in offers" :key="index">
            <div class="border-2 border-gray-900 rounded-lg p-4 space-y-4">
                <div class="flex justify-between items-start">
                    <h4 class="text-base">
                        Offer Variation <span x-text="index + 1"></span>
                    </h4>

                    <template x-if="errors.offers">
                        <p class="text-xs text-red-500" x-text="errors.offers[0]"></p>
                    </template>

                    <button type="button" x-show="offers.length > 1" @click="removeOffer(index)" class="text-gray-400 hover:text-red-400">
                        <x-sb.common.icons.trash class="w-5 h-5" />
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">SKU</label>
                        <input type="text" x-model="offer.sku"
                               class="secondary-input">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Price (MDL)</label>
                        <input type="number" x-model="offer.price"
                               class="secondary-input">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Stock</label>
                        <input type="number" x-model="offer.stock"
                               class="secondary-input">
                    </div>
                </div>

                <hr class="border-gray-700">

                <div x-show="chosenProperties.length > 0">
                    <h4 class="text-sm font-medium mb-2">Properties</h4>
                    <div class="grid grid-cols-2 gap-3">
                        <template x-for="property in offer.properties" :key="property.id">
                            <div class="space-y-1.5">
                                <label class="flex items-center gap-2 text-sm text-gray-400">
                                    <span x-text="property.name"></span>
                                    <span class="text-xs text-gray-500 font-mono lowercase" x-text="`(${property.code})`"></span>
                                </label>

                                <template x-if="property.type === 'string'">
                                    <input
                                        type="text"
                                        x-model="property.value"
                                        class="secondary-input"
                                    >
                                </template>

                                <template x-if="property.type === 'number'">
                                    <input
                                        type="number"
                                        x-model="property.value"
                                        class="secondary-input"
                                    >
                                </template>

                                <template x-if="property.type === 'boolean'">
                                    <select
                                        x-model="property.value"
                                        class="w-full bg-gray-800 border border-gray-700 rounded-md px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500"
                                    >
                                        <option value="">Select option</option>
                                        <option value="true">Yes</option>
                                        <option value="false">No</option>
                                    </select>
                                </template>

                                <div class="flex justify-between items-center text-xs text-gray-500">
                                    <span x-text="property.type"></span>
                                    <button
                                        type="button"
                                        @click="toggleProperty(property, false)"
                                        class="text-gray-500 hover:text-red-400 transition-colors flex gap-1 items-center"
                                    >
                                        <x-sb.common.icons.x-mark class="w-3.5 h-3.5" /> remove
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </template>

        <input
            type="hidden"
            name="offers"
            x-model="JSON.stringify(offers)"
        >

        <x-sb.common.modals.default name="choose-offer-properties-modal" maxWidth="4xl">
            <div class="p-4 flex flex-col gap-4">
                Adding properties to product offer
                <hr class="border-gray-700">

                <div x-show="chosenProperties.length > 0" class="space-y-2">
                    <div class="flex justify-between items-center border-b border-gray-800 pb-1">
                        <h3 class="text-sm font-medium text-gray-300 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span>
                            <span>Selected</span>
                            <span class="text-gray-500 text-xs font-normal" x-text="`(${chosenProperties.length})`"></span>
                        </h3>
                        <button type="button" @click="chosenProperties = []" class="text-xs text-gray-500 hover:text-red-400 transition-colors flex items-center gap-1">
                            <x-sb.common.icons.x-mark class="w-3.5 h-3.5" />
                            <span>Clear</span>
                        </button>
                    </div>

                    <div class="flex flex-wrap gap-1.5">
                        <template x-for="property in chosenProperties" :key="property.id">
                            <div @click="toggleProperty(property, false)" class="relative group cursor-pointer bg-gray-900/80 rounded border border-gray-800 hover:border-gray-700 transition-colors">
                                <div class="px-2.5 py-1.5 pr-5 flex items-center gap-1.5">
                                    <span x-show="property.is_required" class="text-red-500 text-xs">*</span>
                                    <div class="truncate" :title="`${property.name} (${property.type})`">
                                        <div class="text-sm font-medium text-gray-200 truncate" x-text="property.name"></div>
                                        <div class="text-[11px] text-gray-500 font-mono lowercase" x-text="property.code"></div>
                                    </div>
                                    <button class="absolute right-1 top-1/2 -translate-y-1/2 text-gray-600 group-hover:text-red-500 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <x-sb.common.icons.x-mark class="w-3 h-3" />
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="grid grid-cols-[2fr_1fr]">
                    <div class="space-y-3">
                        <x-sb.common.inputs.search class="w-full" x-model="searchInProperties" />

                        <div class="bg-gray-800/30 rounded-lg border border-gray-700 divide-y divide-gray-700 max-h-96 overflow-y-auto invisible-scrollbar">
                            <template x-for="property in filteredProperties" :key="property.id">
                                <label class="flex items-center gap-3 p-3 hover:bg-gray-700/50 transition-colors cursor-pointer">
                                    <x-inputs.checkbox
                                        x-bind:id="'prop-'+property.id"
                                        x-bind:checked="isChosen(property)"
                                        @change="toggleProperty(property, $event.target.checked)"
                                        class="shrink-0"
                                    />
                                    <div class="min-w-0">
                                        <div class="flex items-baseline gap-1.5">
                                            <span x-text="property.name" class="font-medium truncate"></span>
                                            <span x-text="property.code" class="lowercase font-mono text-gray-400 text-xs truncate"></span>
                                        </div>
                                        <div class="flex items-center gap-2 mt-1 text-xs text-gray-400">
                                            <span x-text="property.type"></span>
                                            <span x-show="property.is_required" class="text-red-400">Required</span>
                                        </div>
                                    </div>
                                </label>
                            </template>

                            <div x-show="filteredProperties.length === 0" class="p-4 text-center text-gray-400">
                                No properties found
                            </div>
                        </div>
                    </div>
                    <div>
                        <x-sb.catalog.cp.properties.form-ajax.post :showMini="true" label="Create new property" />
                    </div>
                </div>
            </div>
        </x-sb.common.modals.default>
    </x-sb.common.wrappers.cp-default>
</div>

@push('scripts')
    <script>
        function offerManager() {
            return {
                offers: [],
                errors: @json($errors->getMessages()),
                allProperties: @json($properties),
                searchInProperties: '',
                chosenProperties: [],

                init() {
                    this.initOffers(@json(old('variant', $offers) ?? []));
                },

                initOffers(offers) {
                    if (typeof offers === 'string') {
                        offers = JSON.parse(offers);
                    }

                    if (!offers || offers.length === 0) {
                        return this.addOffer();
                    }

                    this.offers = offers.map(offer => ({
                        sku: offer.sku,
                        price: offer.prices?.[0]?.value ?? 0,
                        stock: offer.quantity ?? 0,
                        properties:
                            offer.properties
                            ?? offer.propertyValues?.map(({ value, property }) => ({
                                ...property,
                                value,
                            }))
                            ?? [],
                    }));

                    this.chosenProperties = this.offers[0]?.properties?.map(({ value, ...rest }) => rest) ?? [];
                },

                toggleProperty(property, checked) {
                    if (checked) {
                        if (!this.chosenProperties.some(p => p.id === property.id)) {
                            this.chosenProperties.push(property);

                            this.offers.forEach(offer => {
                                if (!offer.properties.some(p => p.id === property.id)) {
                                    offer.properties.push({...property, value: ''});
                                }
                            });
                        }
                    } else {
                        this.chosenProperties = this.chosenProperties.filter(p => p.id !== property.id);

                        this.offers.forEach(offer => {
                            offer.properties = offer.properties.filter(p => p.id !== property.id);
                        });
                    }
                },

                isChosen(property) {
                    return this.chosenProperties.some(p => p.id === property.id);
                },

                addOffer() {
                    this.offers.push({
                        sku: '',
                        price: 0,
                        stock: 0,
                        properties: [],
                    });
                },

                get filteredProperties() {
                    if (!this.searchInProperties) return this.allProperties;

                    return this.allProperties.filter(prop =>
                        prop.name.toLowerCase().includes(this.searchInProperties.toLowerCase())
                    );
                },
            }
        }
    </script>
@endpush
