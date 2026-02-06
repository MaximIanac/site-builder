<script setup>
import {ref, onMounted, watch, computed} from 'vue'
import { Button } from '@/components/ui/button'
import { Plus } from 'lucide-vue-next'
import VariantElement from "@/components/cp/modules/catalog/products/blocks/variant/VariantElement.vue";
import PropertyPicker
    from "@/components/cp/modules/catalog/properties/list/PropertyPicker.vue";
import VariantUniquePropertyDialog
    from "@/components/cp/modules/catalog/properties/shared/dialogs/VariantUniquePropertyDialog.vue";
import { v4 as uuidv4 } from 'uuid';
import useLocalizedSchema from "@/composables/validation/useLocalizedSchema.js";

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

const emits = defineEmits([
    'create:property',
    'update:variants',
    'update:variant-properties',
    'update:add-variant',
    'update:remove-variant'
])

const variantProperties = ref([])
const inheritedPropertiesRef = ref(props.inheritedProperties)
const uniquePropertiesRef = ref([])
const showPropertiesModal = ref(false)

const setUniqueProperties = (properties) => {
    uniquePropertiesRef.value = properties.filter(unique => !props.inheritedProperties.some(i => i.id === unique.id))

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

const addVariant = () => {
    emits("update:add-variant", {
        id: uuidv4(),
        sku: '',
        price: 0,
        quantity: 0,
        justCreated: true,
        properties: uniquePropertiesRef.value
    })
}

const normalizeVariants = (variants) => {
    setUniqueProperties(variants[0].properties)

    emits(
        'update:variants',
        variants.map(variant => ({
            ...variant,
            properties:
                variant.properties?.map(property => ({
                    id: property.id,
                    name: property.name,
                    code: property.code,
                    type: property.type,
                    value: useLocalizedSchema().ensureObject(property?.pivot?.translations)
                }))
        }))
    )
}

watch([() => props.inheritedProperties], ([inProps]) => {
    inheritedPropertiesRef.value = inProps

    uniquePropertiesRef.value = uniquePropertiesRef.value.filter(
        unique => !inProps.some(i => i.id === unique.id)
    )
}, { deep: true })

onMounted(() => {
    if (!props.variants || props.variants.length === 0) {
        addVariant()
    } else {
        normalizeVariants(props.variants)
    }
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
                @remove="(id) => emits('update:remove-variant', id)"
            />

            <!-- Add Offer Button -->
            <Button
                type="button"
                variant="outline"
                @click="addVariant"
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
