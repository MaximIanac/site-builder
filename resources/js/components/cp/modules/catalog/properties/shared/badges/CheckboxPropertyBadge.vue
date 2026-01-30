<script setup>
import {Checkbox} from "@/components/ui/checkbox/index.js";
import {Label} from "@/components/ui/label/index.js";
import {Badge} from "@/components/ui/badge/index.js";

const emit = defineEmits(["toggle"])
const props = defineProps({
    property: {
        type: Object,
        required: true
    },
    checked: {
        type: Boolean,
        required: true
    },
    disabled: {
        type: Boolean,
        default: false,
    },
})

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
    <div class="flex items-center gap-2 cursor-pointer">
        <Label :for="property.code" class="cursor-pointer flex-1">
            <Checkbox
                :id="property.code"
                :model-value="checked"
                :disabled="disabled"
                @update:model-value="$emit('toggle', props.property)"
            />

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
</template>

<style scoped>

</style>
