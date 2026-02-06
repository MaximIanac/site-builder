<script setup>
import {computed} from "vue";
import {Input} from "@/components/ui/input/index.ts";
import {Label} from "@/components/ui/label/index.ts";
import { Textarea } from "@/components/ui/textarea/index.ts"

const props = defineProps({
    field: Object,
    locale: String,
    modelValue: String,
    isErrored: {
        type: Boolean,
        default: () => false
    },
})
const emit = defineEmits(['update:modelValue'])

const value = computed({
    get: () => props.modelValue || null,
    set: (val) => emit('update:modelValue', val)
})
</script>

<template>
    <div class="space-y-2">
        <!-- Input field -->
        <div v-if="field.type === 'input'">
            <Label :for="`${field.name}_${locale}`" class="text-sm font-medium">
                {{ field.label }} <span class="text-muted-foreground text-xs font-mono">({{ locale }})</span>
            </Label>
            <Input
                :id="`${field.name}_${locale}`"
                v-model="value"
                :placeholder="field.placeholder"
                :aria-invalid="isErrored"
            />
        </div>

        <!-- Textarea field -->
        <div v-else-if="field.type === 'textarea'">
            <Label :for="`${field.name}_${locale}`" class="text-sm font-medium">
                {{ field.label }} <span class="text-muted-foreground text-xs font-mono">({{ locale }})</span>
            </Label>
            <Textarea
                :id="`${field.name}_${locale}`"
                v-model="value"
                :rows="field.rows || 3"
                :placeholder="field.placeholder"
                :aria-invalid="isErrored"
            />
        </div>
    </div>
</template>
