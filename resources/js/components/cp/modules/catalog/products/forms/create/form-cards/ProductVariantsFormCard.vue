<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { Button } from '@/components/ui/button'
import { X, Plus, Trash2, MoveVertical, Check } from 'lucide-vue-next'
import VariantElement from "@/components/cp/modules/catalog/products/blocks/variant/VariantElement.vue";
import PropertyPicker
    from "@/components/cp/modules/catalog/properties/list/PropertyPicker.vue";
import VariantUniquePropertyDialog
    from "@/components/cp/modules/catalog/properties/shared/dialogs/VariantUniquePropertyDialog.vue";

const props = defineProps({
    variants: {
        type: Array,
        default: () => []
    },
    inheritedProperties: {
        type: Array,
        default: () => []
    }
})

const emits = defineEmits(['create:property', 'update:variant-properties'])

const variants = ref([])
const variantProperties = ref([])
const inheritedPropertiesRef = ref([])
const uniquePropertiesRef = ref([])

const showPropertiesModal = ref(false)

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
            inheritedProperties.value = variants.value[0].properties.map(({ value, ...rest }) => rest)
        }
    } catch (error) {
        console.error('Error parsing variant:', error)
        addOffer()
    }
}

const setUniqueProperties = (properties) => {
    uniquePropertiesRef.value = properties

    const map = new Map();

    [...variantProperties.value, ...properties].forEach(p => {
        map.set(p.id, p)
    })

    handleVariantProperties(Array.from(map.values()))
}

const handleVariantProperties = (props) => {
    variantProperties.value = props;

    emits("update:variant-properties", variantProperties.value)
}

const addOffer = () => {
    variants.value.push({
        sku: '',
        price: 0,
        stock: 0,
    })
}

watch([() => props.inheritedProperties], ([inProps]) => {
    inheritedPropertiesRef.value = inProps

    uniquePropertiesRef.value = uniquePropertiesRef.value.filter(
        unique => !inProps.some(i => i.id === unique.id)
    )
}, { deep: true })

onMounted(() => {
    initVariants(props.variants)
})
</script>

<template>
    <div class="space-y-4">
        <h2 class="text-base font-semibold">Variants</h2>

        <div class="space-y-6">
            <!-- Properties Selection -->
            <div class="space-y-2">
                <!-- Selected Properties for Variants -->
                <PropertyPicker
                    :model-value="variantProperties"
                    @update:model-value="handleVariantProperties"

                    :inherited-properties="inheritedPropertiesRef"
                    :unique-properties="uniquePropertiesRef"
                    @update:unique-properties="(v) => uniquePropertiesRef = v"
                />

                <Button
                    class="self-start"
                    type="button"
                    variant="default"
                    size="sm"
                    @click="showPropertiesModal = true"
                >
                    <Plus class="mr-2 h-4 w-4" />
                    Add Properties
                </Button>
            </div>

            <!-- Variant List -->
            <VariantElement
                v-for="(variant, index) in variants"
                :variant="variant"
                :index="index"
                :variantsCount="variants.length"
                :variant-properties="variantProperties"
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
    <VariantUniquePropertyDialog
        v-model:open="showPropertiesModal"
        :unique-properties="uniquePropertiesRef"
        :inherited-properties="inheritedPropertiesRef"
        @update:unique-properties="setUniqueProperties"
    />
</template>
