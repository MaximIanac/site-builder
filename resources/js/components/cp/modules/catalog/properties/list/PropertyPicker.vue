<script setup>
import {computed, ref, watch} from "vue";
import VariantPropertyBadge
    from "@/components/cp/modules/catalog/properties/shared/badges/VariantPropertyBadge.vue";

const emits = defineEmits(['update:model-value', 'update:unique-properties'])
const props = defineProps({
    modelValue: { type: Array, default: () => [] },
    inheritedProperties: {
        type: Array,
        default: () => [],
    },
    uniqueProperties: {
        type: Array,
        default: () => [],
    },
})

const pickedVariantProperties = ref([...props.modelValue]);

const inheritedPropertiesComp = computed(() => props.inheritedProperties);
const uniquePropertiesComp = computed(() => props.uniqueProperties);

const toggleProperty = (property) => {
    if (!pickedVariantProperties.value.some(p => p.id === property.id)) {
        pickedVariantProperties.value.push(property)
    } else {
        pickedVariantProperties.value = pickedVariantProperties.value.filter(p => p.id !== property.id)
    }

    emits('update:model-value', pickedVariantProperties.value)
}

const toggleUniqueProperty = (property) => {
    emits('update:unique-properties', uniquePropertiesComp.value.filter(p => p.id !== property.id))
    emits('update:model-value', pickedVariantProperties.value.filter(p => p.id !== property.id));
}

const isPickedProperty = (property) => {
    return pickedVariantProperties.value.some(p => p.id === property.id)
}

watch(() => props.modelValue, (val) => {
    pickedVariantProperties.value = [...val];
});
</script>

<template>
    <div class="space-y-3">
        <div v-if="inheritedPropertiesComp.length">
            <div class="text-[11px] font-medium text-muted-foreground/80 tracking-wide uppercase mb-1 pl-0.5">
                Inherited
            </div>
            <div class="flex flex-wrap gap-2">
                <VariantPropertyBadge
                    v-for="property in inheritedPropertiesComp.slice(0, 3)"
                    :key="property.id"
                    :property="property"
                    :is-picked="isPickedProperty(property)"
                    @click="toggleProperty(property)"
                />
            </div>
        </div>

        <div v-if="uniquePropertiesComp.length">
            <div class="text-[11px] font-medium text-muted-foreground/80 tracking-wide uppercase mb-1.5 pl-0.5 mt-1">
                Custom / Unique to this product
            </div>
            <div class="flex flex-wrap gap-2">
                <VariantPropertyBadge
                    v-for="property in uniquePropertiesComp.slice(0, 3)"
                    :key="property.id"
                    :property="property"
                    :is-picked="isPickedProperty(property)"
                    @click="toggleUniqueProperty(property)"
                />
            </div>
        </div>

        <div
            v-if="!inheritedPropertiesComp.length && !uniquePropertiesComp.length"
            class="text-sm text-muted-foreground italic"
        >
            There are no chosen properties
        </div>
    </div>
</template>
