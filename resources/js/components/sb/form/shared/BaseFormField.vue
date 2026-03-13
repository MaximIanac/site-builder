<script setup>
import {
    Field, FieldDescription, FieldError, FieldLabel,
} from '@/components/ui/field/index.js'
import { Field as VeeField } from 'vee-validate'
import {getErrorMessages} from "@/lib/utils.js";

const props = defineProps({
    name: {
        type: String,
        required: true
    },
    label: String,
    placeholder: String,
    description: String,
    rules: [String, Object]
});
</script>

<template>
    <VeeField v-slot="{ field, errors, meta }" :name="name" :rules="rules" :label="label">
        <Field :data-invalid="!!errors.length">
            <FieldLabel v-if="label" :for="field.name">
                {{ label }}
            </FieldLabel>

            <slot
                v-bind="{
                    field,
                    errors,
                    meta,
                    placeholder,
                    label,
                    description,
                    name
                }"
            >
                <!-- Fallback -->
                <div style="background: yellow; padding: 10px;">
                    DEFAULT SLOT CONTENT (slot is empty!)
                </div>
            </slot>

            <slot name="error">
                <FieldError :errors="getErrorMessages(errors)" />
            </slot>

            <FieldDescription v-if="description">
                {{ description }}
            </FieldDescription>
        </Field>
    </VeeField>
</template>
