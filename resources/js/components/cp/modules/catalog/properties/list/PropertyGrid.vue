<script setup>
import { computed } from 'vue'
import { Card, CardHeader, CardTitle, CardContent } from '@/components/ui/card'
import { Label } from '@/components/ui/label'
import { Checkbox } from '@/components/ui/checkbox'
import { Badge } from '@/components/ui/badge'
import CheckboxPropertyBadge from "@/components/cp/modules/catalog/properties/shared/badges/CheckboxPropertyBadge.vue";

const props = defineProps({
    properties: {
        type: Array,
        required: true
    },
    addedProperties: {
        type: Array,
        default: () => []
    },
    inheritedProperties: {
        type: Array,
        default: () => []
    }
})

const emits = defineEmits(['toggle:property'])

const title = computed(() => 'All properties')

const isAdded = (property) => {
    return props.addedProperties.some(p => p.id === property.id)
}

const isInherited = (property) => {
    return props.inheritedProperties.some(p => p.id === property.id)
}

const toggleProperty = (property) => {
    emits('toggle:property', property)
}
</script>

<template>
    <Card class="w-1/4 min-w-[150px] lg:min-w-[300px] max-h-[700px] overflow-y-auto">
        <CardHeader>
            <CardTitle class="text-base">
                {{ title }}
            </CardTitle>
        </CardHeader>

        <CardContent class="grid grid-cols-1 lg:grid-cols-2 gap-2">
            <CheckboxPropertyBadge
                v-for="property in properties"
                :key="property.id"
                :property="property"
                :checked="isAdded(property) || isInherited(property)"
                :disabled="isInherited(property)"
                @toggle="(property) => toggleProperty(property)"
            />
        </CardContent>
    </Card>
</template>
