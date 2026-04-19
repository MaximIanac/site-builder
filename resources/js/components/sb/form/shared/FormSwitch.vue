<script setup>
import BaseFormField from "@/components/sb/form/shared/BaseFormField.vue";
import {computed} from "vue";
import Switch from "@/components/ui/switch/Switch.vue";

const props = defineProps({
    modelValue: {
        type: Boolean,
        default: false
    },
})

const emits = defineEmits(['update:modelValue']);

const value = computed({
    get: () => props.modelValue,
    set: (val) => emits('update:modelValue', val)
})
</script>

<template>
    <BaseFormField v-bind="$props">
        <template #default="{ field, placeholder, errors }">
            <div>
                <Switch
                    :id="field.name"
                    v-model="value"
                    v-bind="{
                        name: field.name,
                        ...$attrs
                    }"
                    :aria-invalid="!!errors.length"
                    class="data-[state=checked]:bg-purple-700/50 data-[state=unchecked]:bg-gray-300 dark:data-[state=unchecked]:bg-neutral-600 [&_span]:bg-background/75"
                />

            </div>
        </template>
    </BaseFormField>
</template>
