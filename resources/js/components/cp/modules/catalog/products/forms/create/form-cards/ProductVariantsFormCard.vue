<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { Button } from '@/components/ui/button'
import { Card, CardContent } from '@/components/ui/card'
import { Input } from '@/components/ui/input'
import { Separator } from '@/components/ui/separator'
import { Badge } from '@/components/ui/badge'
import { Checkbox } from '@/components/ui/checkbox'
import { Dialog, DialogContent, DialogHeader, DialogTitle } from '@/components/ui/dialog'
import { Search } from 'lucide-vue-next'
import { X, Plus, Trash2, MoveVertical, Check } from 'lucide-vue-next'
import PropertyCreateForm from "@/components/cp/modules/catalog/properties/forms/create/PropertyCreateForm.vue";
import {PropertyUsageType} from "@/enums/PropertyUsageType.js";
import VariantElement from "@/components/cp/modules/catalog/products/blocks/variant/VariantElement.vue";

const props = defineProps({
    variants: {
        type: Array,
        default: () => []
    },
    properties: {
        type: Array,
        default: () => []
    }
})

// Emits
const emit = defineEmits(['property-created'])

// Reactive state
const variants = ref([])
const errors = ref({})
const allProperties = ref(props.properties || [])
const searchInProperties = ref('')
const chosenProperties = ref([{
    code: 'test',
    name: 'test',
    type: 'string',
}])
const showPropertiesModal = ref(false)
const newProperty = ref({
    name: '',
    code: '',
    type: 'string',
    is_required: false
})

// Computed
const filteredProperties = computed(() => {
    if (!searchInProperties.value.trim()) return allProperties.value

    const search = searchInProperties.value.toLowerCase()
    return allProperties.value.filter(prop =>
        prop.name.toLowerCase().includes(search) ||
        prop.code.toLowerCase().includes(search) ||
        prop.type.toLowerCase().includes(search)
    )
})

// Methods
const initVariants = (variantsData) => {
    if (!variantsData || variantsData.length === 0) {
        addOffer()
        return
    }

    try {
        const parsed = typeof variantsData === 'string' ? JSON.parse(variantsData) : variantsData
        variants.value = parsed.map(offer => ({
            sku: offer.sku || '',
            price: offer.price || offer.prices?.[0]?.value || 0,
            stock: offer.stock || offer.quantity || 0,
            properties: offer.properties?.map(prop => ({
                ...prop,
                value: prop.value || ''
            })) || offer.propertyValues?.map(({ value, property }) => ({
                ...property,
                value: value || ''
            })) || []
        }))

        // Initialize chosen properties from first offer
        if (variants.value.length > 0) {
            chosenProperties.value = variants.value[0].properties.map(({ value, ...rest }) => rest)
        }
    } catch (error) {
        console.error('Error parsing variant:', error)
        addOffer()
    }
}

const toggleProperty = (property, isChecked) => {
    if (isChecked) {
        if (!chosenProperties.value.some(p => p.id === property.id)) {
            chosenProperties.value.push(property)

            // Add property to all variant
            variants.value.forEach(offer => {
                if (!offer.properties.some(p => p.id === property.id)) {
                    offer.properties.push({
                        ...property,
                        value: ''
                    })
                }
            })
        }
    } else {
        chosenProperties.value = chosenProperties.value.filter(p => p.id !== property.id)

        // Remove property from all variant
        variants.value.forEach(offer => {
            offer.properties = offer.properties.filter(p => p.id !== property.id)
        })
    }
}

const isChosen = (property) => {
    return chosenProperties.value.some(p => p.id === property.id)
}

const addOffer = () => {
    variants.value.push({
        sku: '',
        price: 0,
        stock: 0,
        properties: chosenProperties.value.map(prop => ({
            ...prop,
            value: ''
        }))
    })
}

const clearChosenProperties = () => {
    chosenProperties.value = []
    variants.value.forEach(offer => {
        offer.properties = []
    })
}

const createProperty = async () => {
    if (!newProperty.value.name || !newProperty.value.code) {
        errors.value.property = ['Name and code are required']
        return
    }

    try {
        const property = {
            id: Date.now(), // Temporary ID
            ...newProperty.value
        }

        allProperties.value.push(property)

        // Clear form
        newProperty.value = {
            name: '',
            code: '',
            type: 'string',
            is_required: false
        }

        errors.value.property = []

        emit('property-created', property)
    } catch (error) {
        errors.value.property = [error.message]
    }
}

// Watch for variant changes to update hidden input
watch(variants, (newOffers) => {
    // You can emit this to parent or update a hidden input
}, { deep: true })

// Initialize
onMounted(() => {
    initVariants(props.variants)
})
</script>

<template>
    <div class="space-y-4">
        <h2 class="text-base font-semibold">Product Variants</h2>

        <div class="space-y-6">
            <!-- Properties Selection -->
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-3">
                    <Button
                        type="button"
                        variant="default"
                        size="sm"
                        @click="showPropertiesModal = true"
                    >
                        <Plus class="mr-2 h-4 w-4" />
                        Add Properties
                    </Button>

                    <!-- Selected Properties Badges -->
                    <div v-if="chosenProperties.length > 0" class="flex-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <Badge
                                v-for="property in chosenProperties.slice(0, 3)"
                                :key="property.id"
                                variant="secondary"
                                class="group cursor-pointer hover:bg-destructive/20 hover:text-destructive pr-7 transition-colors"
                                @click="toggleProperty(property, false)"
                            >
                                <span v-if="property.is_required" class="text-destructive mr-1">*</span>
                                <span class="font-medium truncate max-w-[120px]">
                                    {{ property.name }}
                                </span>
                                <span class="text-muted-foreground text-xs ml-1 font-mono lowercase">
                                    {{ property.code }}
                                </span>

                                <span class="absolute right-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <X class="h-3 w-3" />
                                </span>
                            </Badge>

                            <Button
                                v-if="chosenProperties.length > 3"
                                type="button"
                                variant="ghost"
                                size="sm"
                                @click="showPropertiesModal = true"
                                class="text-xs text-primary hover:text-primary/80"
                            >
                                +{{ chosenProperties.length - 3 }} more
                            </Button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Variant List -->
            <VariantElement
                v-for="(variant, index) in variants"
                :variant="variant"
                :index="index"
                :variantsCount="variants.length"
                :variant-properties="chosenProperties"
            />

            <!-- Add Offer Button -->
            <Button
                type="button"
                variant="outline"
                @click="addOffer"
                class="w-full"
            >
                <Plus class="mr-2 h-4 w-4" />
                Add Variant
            </Button>
        </div>
    </div>

    <!-- Properties Selection Modal -->
    <Dialog v-model:open="showPropertiesModal">
        <DialogContent class="min-w-3/4 md:min-w-1/2 w-auto max-w-4xl">
            <DialogHeader>
                <DialogTitle>Add Properties to Product Offer</DialogTitle>
            </DialogHeader>

            <Separator />

            <!-- Selected Properties -->
            <div v-if="chosenProperties.length > 0" class="space-y-3">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <div class="h-2 w-2 rounded-full bg-primary"></div>
                        <h3 class="text-sm font-medium">
                            Selected Properties
                            <span class="text-muted-foreground font-normal">
                                ({{ chosenProperties.length }})
                            </span>
                        </h3>
                    </div>

                    <Button
                        type="button"
                        variant="ghost"
                        size="sm"
                        @click="clearChosenProperties"
                        class="h-7 text-xs text-muted-foreground hover:text-destructive"
                    >
                        <X class="mr-1 h-3 w-3" />
                        Clear All
                    </Button>
                </div>

                <div class="flex flex-wrap gap-2">
                    <Badge
                        v-for="property in chosenProperties"
                        :key="property.id"
                        variant="secondary"
                        class="group cursor-pointer hover:bg-destructive/20 hover:text-destructive pr-7"
                        @click="toggleProperty(property, false)"
                    >
                        <span v-if="property.is_required" class="text-destructive mr-1">*</span>
                        <div class="truncate max-w-[160px]">
                            <div class="text-sm font-medium truncate">
                                {{ property.name }}
                            </div>
                            <div class="text-xs text-muted-foreground font-mono lowercase truncate">
                                {{ property.code }}
                            </div>
                        </div>

                        <X class="absolute right-1.5 h-3 w-3 opacity-0 group-hover:opacity-100 transition-opacity" />
                    </Badge>
                </div>
            </div>

            <!-- Properties Selection -->
            <div class="flex basis-3xs flex-wrap gap-6">
                <!-- Properties List -->
                <div class="flex-grow space-y-4">
                    <div class="relative">
                        <Search class="absolute left-3 top-3 h-4 w-4 text-muted-foreground" />
                        <Input
                            v-model="searchInProperties"
                            placeholder="Search properties..."
                            class="pl-9"
                        />
                    </div>

                    <div class="border rounded-lg overflow-hidden">
                        <div class="max-h-96 overflow-y-auto">
                            <div
                                v-for="property in filteredProperties"
                                :key="property.id"
                                class="flex items-center gap-3 p-3 hover:bg-accent/50 transition-colors border-b last:border-b-0"
                            >
                                <Checkbox
                                    :id="'prop-' + property.id"
                                    :checked="isChosen(property)"
                                    @update:checked="(checked) => toggleProperty(property, checked)"
                                />

                                <div class="min-w-0 flex-1">
                                    <div class="flex items-baseline gap-2">
                                        <span class="font-medium truncate">
                                            {{ property.name }}
                                        </span>
                                        <span class="text-xs text-muted-foreground font-mono lowercase truncate">
                                            {{ property.code }}
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-2 mt-1">
                                        <Badge variant="outline" class="text-xs capitalize">
                                            {{ property.type }}
                                        </Badge>
                                        <Badge
                                            v-if="property.is_required"
                                            variant="destructive"
                                            class="text-xs"
                                        >
                                            Required
                                        </Badge>
                                    </div>
                                </div>
                            </div>

                            <div
                                v-if="filteredProperties.length === 0"
                                class="p-3 text-center text-muted-foreground"
                            >
                                No properties found
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create New Property -->
                <div class="flex-grow space-y-4">
                    <h4 class="font-medium">Create New Property</h4>

                    <Card>
                        <CardContent class="pt-6 space-y-4">
                            <PropertyCreateForm :usage_type="PropertyUsageType.PRODUCT" />
                        </CardContent>
                    </Card>
                </div>
            </div>
        </DialogContent>
    </Dialog>
</template>
