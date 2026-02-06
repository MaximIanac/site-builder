<script setup>
import { Badge } from "@/components/ui/badge/index.js";
import FormInput from "@/components/sb/form/shared/FormInput.vue";
import {computed} from "vue";
import {useField} from "vee-validate";

const props = defineProps({
    property: {
        type: Object,
        required: true,
    },
    inputName: {
        type: String,
        required: true
    },
    locale: {
        type: String,
        required: true
    },
});

const emits = defineEmits(['update:modelValue']);

const fieldName = computed(() => `${props.inputName}value.${props.locale}`)

const { value: fieldValue, errorMessage } = useField(fieldName.value);
</script>

<template>
    <div class="group relative space-y-1">
        <div
            v-if="property.is_required"
            class="absolute -left-1 top-4"
            title="Required field"
        >
            <div class="w-2 h-2 bg-destructive rounded-full"></div>
        </div>

        <div class="flex items-center gap-2">
            <span class="text-sm font-medium text-foreground">
                {{ property.name }}
            </span>
            <Badge
                variant="secondary"
                class="text-xs font-normal h-5 px-1.5 bg-muted text-muted-foreground border-border"
            >
                {{ property.code }}
            </Badge>

            <span class="text-muted-foreground text-xs font-mono">({{ locale }})</span>
        </div>

        <FormInput
            v-if="property.type === 'string'"
            v-model="fieldValue"
            type="text"
            :name="fieldName"
            :placeholder="`Enter ${property.name.toLowerCase()}`"
        />

<!--        <Input-->
<!--            v-if="property.type === 'string'"-->
<!--            v-model="property.value"-->
<!--            type="text"-->
<!--            :placeholder="`Enter ${property.name.toLowerCase()}`"-->
<!--            class="w-full bg-background border-input focus:border-primary focus:ring-1 focus:ring-ring"-->
<!--        />-->

        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <Badge
                    variant="outline"
                    class="text-xs font-mono h-6 px-2 border-border bg-background text-foreground"
                >
                    {{ property.type }}
                </Badge>
            </div>
        </div>

        <div
            v-if="property.is_required"
            class="absolute left-0 top-0 bottom-0 w-0.5 bg-primary"
        ></div>
    </div>
</template>
