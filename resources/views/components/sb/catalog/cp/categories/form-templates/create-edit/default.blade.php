@props([
    'categories' => [],
    'properties' => [],
    'category' => null,
])

<div
    class="space-y-6"
    x-data="categoryManager()"
    @property:created.window="newPropertyCreated($event.detail)"
>
    <div class="flex gap-8">
        <div class="flex-1 space-y-8">
            <!-- Base info -->
            <x-sb.common.wrappers.cp-default class="space-y-4">
                <h4 class="text-base text-text-secondary">Base Information</h4>
                <hr class="my-4 border-gray-300/50 dark:border-gray-600/50">

                <div class="w-full">
                    <x-input-label for="parent_id">Parent Category</x-input-label>
                    <div class="flex items-center gap-3">
                        <x-select.default name="parent_id" class="w-full" x-model="selectedCategory" @change="fetchProperties">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </x-select.default>

                        <button
                            x-show="selectedCategory" x-cloak
                            @click="deselectParentCategory()"
                            type="button"
                            class="bg-indigo-600 p-1 rounded-full"
                        >
                            <x-sb.common.icons.x-mark class="w-5 h-5" />
                        </button>
                    </div>
                </div>

                <div class="mb-8">
                    <x-sb.common.panels.locale-tabs
                        :fields="[
                            [
                                'type' => 'input',
                                'name' => 'name',
                                'label' => 'Name',
                                'value' => fn($locale) => $category?->translatable['name'][$locale],
                                'placeholder' => 'Enter category name'
                            ],
                            [
                                'type' => 'textarea',
                                'name' => 'description',
                                'label' => 'Description',
                                'value' => fn($locale) => $category?->translatable['description'][$locale],
                                'rows' => 4
                            ]
                        ]"
                    />
                </div>
            </x-sb.common.wrappers.cp-default>

            <!-- Properties Grid -->
            <x-sb.common.wrappers.cp-default>
                <div class="space-y-6">
                    <div class="space-y-2">
                        <h4 class="text-base font-medium text-text-secondary">Category Properties Configuration</h4>
                        <hr class="border-gray-300/50 dark:border-gray-600/50">
                        <p class="text-xs text-text-tertiary">
                            Manage inherited and additional properties for this category
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Inherited Properties Column -->
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="font-mono text-xs uppercase text-text-secondary">
                                    Inherited Properties
                                    <span x-show="inheritedProperties.length > 0"
                                          class="ml-2 text-xs font-normal text-gray-500"
                                          x-text="`(${inheritedProperties.length})`">
                                    </span>
                                </span>
                                <span x-show="inheritedProperties.length === 0" class="text-xs italic text-gray-500">
                                    No inherited properties
                                </span>
                            </div>

                            <div class="flex flex-wrap gap-2 min-h-[40px] border border-dashed border-gray-200 dark:border-gray-700 rounded-lg p-2">
                                <template x-for="property in inheritedProperties" :key="property.id">
                                    <x-sb.common.badges.default class="max-w-[200px] group">
                                        <span class="truncate flex items-center">
                                            <span x-show="property.is_required" class="text-red-400 mr-1">*</span>
                                            <span x-text="property.name" class="font-medium"></span>
                                            <span class="mx-1 text-gray-400">-</span>
                                            <span x-text="property.code" class="lowercase font-mono text-gray-400 text-xs"></span>
                                            <span class="ml-1 text-gray-400/70 text-[9px] font-mono" x-text="`(${property.type})`"></span>
                                        </span>
                                    </x-sb.common.badges.default>
                                </template>
                            </div>
                        </div>

                        <!-- Added Properties Column -->
                        <div class="space-y-3">
                            <div class="flex items-center justify-between ">
                                <span class="font-mono text-xs uppercase text-text-secondary">
                                    Added Properties
                                    <span x-show="addedProperties.length > 0"
                                          class="ml-2 text-xs font-normal text-gray-500"
                                          x-text="`(${addedProperties.length})`">
                                    </span>
                                </span>
                                <span x-show="addedProperties.length === 0" class="text-xs italic text-gray-500">
                                    No additional properties
                                </span>
                            </div>

                            <div class="flex flex-wrap gap-2 min-h-[40px] border border-dashed border-gray-200 dark:border-gray-700 rounded-lg p-2">
                                <template x-for="property in addedProperties" :key="property.id">
                                    <x-sb.common.badges.default class="max-w-[200px] group">
                                        <span class="truncate flex items-center">
                                            <span x-show="property.is_required" class="text-red-400 mr-1">*</span>
                                            <span x-text="property.name" class="font-medium"></span>
                                            <span class="mx-1 text-gray-400">-</span>
                                            <span x-text="property.code" class="lowercase font-mono text-gray-400 text-xs"></span>
                                            <span class="ml-1 text-gray-400/70 text-[9px] font-mono"x-text="`(${property.type})`"></span>
                                        </span>
                                    </x-sb.common.badges.default>
                                </template>
                            </div>

                            <x-sb.common.buttons.add x-on:click="$dispatch('open-modal', 'create-property-modal')">Create Property</x-sb.common.buttons.add>
                        </div>
                    </div>

                    <template x-for="property in inheritedProperties" :key="'inherited-' + property.id">
                        <input type="hidden" name="inherited_properties[]" :value="property.id">
                    </template>

                    <template x-for="property in addedProperties" :key="'added-' + property.id">
                        <input type="hidden" name="added_properties[]" :value="property.id">
                    </template>

                    <div x-show="inheritedProperties.length === 0 && addedProperties.length === 0" class="text-center py-4 text-sm text-gray-500 italic">
                        No properties configured for this category
                    </div>
                </div>
            </x-sb.common.wrappers.cp-default>
         </div>

        <!-- All Properties-->
        <x-sb.common.wrappers.cp-default class="w-1/4 min-w-[150px] lg:min-w-[300px] max-h-[700px] overflow-y-auto">
            <h4 class="text-base text-text-secondary">All properties</h4>
            <hr class="my-4 border-gray-300/50 dark:border-gray-600/50">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-2">
                <template x-for="property in allProperties" :key="property.id">
                    <x-input-label class="flex items-center gap-2 cursor-pointer">
                        <x-inputs.checkbox
                            x-bind:id="property.name"
                            x-bind:checked="isAdded(property) || isInherited(property)"
                            x-bind:disabled="isInherited(property)"
                            @change="toggleProperty(property, $event.target.checked)"
                        />

                        <x-sb.common.badges.default>
                            <span class="truncate" :title="`${property.name} (${property.code}) - ${property.type}`">
                                <template x-if="property.is_required">
                                    <span class="text-red-400">*</span>
                                </template>
                                <span class="lowercase" x-text="property.name"></span>
                                <span class="text-gray-400/70 text-[9px] font-mono" x-text="`(${property.type})`"></span>
                            </span>
                        </x-sb.common.badges.default>
                    </x-input-label>
                </template>
            </div>
        </x-sb.common.wrappers.cp-default>
    </div>

    <x-sb.common.modals.default name="create-property-modal" maxWidth="2xl">
        <x-sb.catalog.cp.properties.form-ajax.post />
    </x-sb.common.modals.default>
</div>

<script>
    function categoryManager() {
        return {
            selectedCategory: @json(old('parent_id', $category?->parent?->id) ?? ''),
            inheritedProperties: [],
            addedProperties: [],
            allProperties: @json($properties),

            async init() {
                await this.fetchProperties();

                if (this.addedProperties.length > 0) {
                    if (typeof this.addedProperties[0] !== 'object') {
                        this.addedProperties = this.addedProperties
                            .map(id => this.allProperties.find(p => p.id === Number(id)))
                            .filter(Boolean);
                    }
                } else {
                    this.addedProperties = @json(old('added_properties', $category?->properties) ?? []);
                }
            },

            async fetchProperties() {
                if (!this.selectedCategory) {
                    this.inheritedProperties = [];
                    return;
                }

                const res = await useAjax().get(
                    "{{ route('api.cp.content.modules.catalog.categories.parentProperties') }}",
                    {category: this.selectedCategory}
                );
                this.inheritedProperties = res.data.data.properties ?? [];

                if (this.addedProperties.length < 1) {
                    this.addedProperties = @json(old('added_properties', $category?->properties) ?? []);
                }

                this.removeInheritedFromAdded()
            },

            isAdded(property) {
                return this.addedProperties.some(p => p.id === property.id);
            },

            isInherited(property) {
                return this.inheritedProperties.some(ip => ip.id === property.id);
            },

            removeInheritedFromAdded() {
                this.addedProperties = this.addedProperties.filter(
                    p => !this.inheritedProperties.some(ip => ip.id === p.id)
                );
            },

            toggleProperty(property, checked) {
                if (checked) {
                    if (!this.addedProperties.some(p => p.id === property.id)) {
                        this.addedProperties.push(property);
                    }
                } else {
                    this.addedProperties = this.addedProperties.filter(p => p.id !== property.id);
                }
            },

            deselectParentCategory() {
                this.selectedCategory = '';
                this.inheritedProperties = [];
            },

            newPropertyCreated(property) {
                this.addedProperties.push(property);
                this.allProperties.push(property);
            }
        }
    }
</script>
