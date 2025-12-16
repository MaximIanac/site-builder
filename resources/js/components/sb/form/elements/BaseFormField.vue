<script setup>
import {
    Field, FieldDescription, FieldError, FieldLabel,
} from '@/components/ui/field/index.js'
import { Field as VeeField } from 'vee-validate'
import {Input} from "@/components/ui/input/index.ts";
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


console.log('BaseFormField props:', props)
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
                        placeholder: placeholder,
                        label: label,
                        description: description,
                        name: name
                    }"
            >
                <!-- Fallback если слот пустой -->
                <div style="background: yellow; padding: 10px;">
                    DEFAULT SLOT CONTENT (slot is empty!)
                </div>
            </slot>

            <FieldError :errors="getErrorMessages(errors)" />

            <FieldDescription v-if="description">
                {{ description }}
            </FieldDescription>
        </Field>
    </VeeField>
</template>
