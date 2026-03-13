<script setup>
import {Input} from "@/components/ui/input/index.ts";
import BaseFormField from "@/components/sb/form/shared/BaseFormField.vue";
import {computed} from "vue";

const props = defineProps({
    type: {
        type: String,
        default: "text"
    },
    modelValue: {
        type: [String, Number],
    },
})

const emits = defineEmits(['update:modelValue']);

const value = computed({
    get: () => props.modelValue ?? '',
    set: (val) => emits('update:modelValue', val)
})
</script>

<template>
    <BaseFormField v-bind="$props">
        <template #default="{ field, placeholder, errors }">
            <Input
                :id="field.name"
                :type="type"
                v-model="value"
                v-bind="{
                    ...field,
                    ...$attrs,
                }"
                :placeholder="placeholder"
                :aria-invalid="!!errors.length"
            />
        </template>
    </BaseFormField>
</template>
