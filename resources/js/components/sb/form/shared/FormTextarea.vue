<script setup>
import BaseFormField from "@/components/sb/form/shared/BaseFormField.vue";
import {computed} from "vue";
import {Textarea} from "@/components/ui/textarea/index.js";

const props = defineProps({
    modelValue: {
        type: [String, Number],
    }
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
            <Textarea
                class="w-full"
                :id="field.name"
                v-model="value"
                v-bind="{
                    ...field,
                    ...$attrs,
                }"
                :rows="field.rows || 3"
                :placeholder="placeholder"
                :aria-invalid="!!errors.length"
            />
        </template>
    </BaseFormField>
</template>

<style scoped>

</style>
