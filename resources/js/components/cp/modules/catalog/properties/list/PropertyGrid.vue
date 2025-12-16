<script setup>
import { computed } from 'vue'
import { Card, CardHeader, CardTitle, CardContent } from '@/components/ui/card'
import { Label } from '@/components/ui/label'
import { Checkbox } from '@/components/ui/checkbox'
import { Badge } from '@/components/ui/badge'

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

const getTypeColor = (type) => {
    const colors = {
        string: 'text-blue-400',
        integer: 'text-green-400',
        boolean: 'text-purple-400',
        float: 'text-orange-400',
        date: 'text-red-400',
        datetime: 'text-pink-400',
        default: 'text-gray-400'
    }
    return colors[type] || colors.default
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
            <div
                v-for="property in properties"
                :key="property.id"
                class="flex items-center gap-2 cursor-pointer"
            >
                <Checkbox
                    :id="property.name"
                    :model-value="isAdded(property) || isInherited(property)"
                    :disabled="isInherited(property)"
                    @update:model-value="() => toggleProperty(property)"
                />

                <Label :for="property.name" class="cursor-pointer flex-1">
                    <Badge variant="secondary" class="w-full truncate px-2 py-1">
                        <span
                            class="truncate flex items-center gap-1"
                            :title="`${property.name} (${property.code}) - ${property.type}`"
                        >
                            <span v-if="property.is_required" class="text-destructive">*</span>
                            <span class="lowercase">{{ property.name }}</span>
                            <span :class="['text-[9px] font-mono', getTypeColor(property.type)]">
                              ({{ property.type }})
                            </span>
                        </span>
                    </Badge>
                </Label>
            </div>
        </CardContent>
    </Card>
</template>
