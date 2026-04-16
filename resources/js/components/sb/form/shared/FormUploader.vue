<script setup>
import BaseFormField from "@/components/sb/form/shared/BaseFormField.vue";
import {computed} from "vue";
import ImageUploader from "@/components/sb/files/ImageUploader.vue";

const props = defineProps({
    modelValue: {
        type: Object,
        required: true
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
            <ImageUploader
                :id="field.name"
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
