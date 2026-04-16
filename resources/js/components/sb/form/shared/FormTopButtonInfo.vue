<script setup>
import {AlertCircle, Braces, CheckCircle2, RotateCcw} from "lucide-vue-next";
import {Badge} from "@/components/ui/badge/index.js";
import {Field} from "@/components/ui/field/index.js";
import {Button} from "@/components/ui/button/index.js";
import {FormType} from "@/enums/FormType.js";

const emits = defineEmits(['reset'])
const props = defineProps({
    formType: {
        type: String,
        validator: (v) => Object.values(FormType).includes(v),
        required: true
    },
    isDirty: Boolean,
    isFormValid: Boolean,
})

console.log(props.formType)

</script>

<template>
    <div
        class="flex items-center gap-4"
        :class="[formType === FormType.CREATE ? 'justify-end' : 'justify-between']"
    >
        <div
            class="flex items-center gap-3"
            :class="{'hidden' : formType === FormType.CREATE}"
        >
            <Badge
                variant="secondary"
                :class="{
                    'text-amber-600': isDirty && !isFormValid,
                    'text-green-600': isDirty && isFormValid,
                    'hidden': !isDirty,
                }"
            >
                <AlertCircle v-if="isDirty && !isFormValid" class="size-4" />
                <CheckCircle2 v-else-if="isDirty && isFormValid" class="size-4" />
                <Braces v-else-if="!isDirty && isFormValid" class="size-4" />

                <span class="text-sm font-medium">
                    <span v-if="!isDirty">No changes</span>
                    <span v-else-if="isDirty && !isFormValid">Form has errors</span>
                    <span v-else-if="isDirty && isFormValid">Ready to save</span>
                </span>
            </Badge>

            <span v-if="isDirty" class="text-sm text-gray-500">
                You have unsaved changes
            </span>
        </div>

        <div class="flex items-center gap-2">
            <Button
                v-if="isDirty"
                type="button"
                variant="outline"
                @click="$emit('reset')"
                class="gap-2"
            >
                <RotateCcw class="w-4 h-4" />
                Reset changes
            </Button>

            <Field orientation="horizontal" class="justify-end">
                <slot />
            </Field>
        </div>
    </div>
</template>
