<script setup>
import {computed} from "vue";
import {Input} from "@/components/ui/input";
import {Label} from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea"

const props = defineProps({
    field: Object,
    locale: String,
    modelValue: String,
})
const emit = defineEmits(['update:modelValue'])

const value = computed({
    get: () => props.modelValue || '',
    set: (val) => emit('update:modelValue', val)
})
</script>

<template>
    <div class="space-y-2">
        <!-- Input field -->
        <div v-if="field.type === 'input'">
            <Label :for="`${field.name}_${locale}`" class="text-sm font-medium">
                {{ field.label }} ({{ locale }})
            </Label>
            <Input
                :id="`${field.name}_${locale}`"
                v-model="value"
                :placeholder="field.placeholder"
            />
        </div>

        <!-- Textarea field -->
        <div v-else-if="field.type === 'textarea'">
            <Label :for="`${field.name}_${locale}`" class="text-sm font-medium">
                {{ field.label }} ({{ locale }})
            </Label>
            <Textarea
                :id="`${field.name}_${locale}`"
                v-model="value"
                :rows="field.rows || 3"
                :placeholder="field.placeholder"
            />
        </div>
    </div>
</template>
