<script setup>
import {Input} from "@/components/ui/input/index.js";
import {Label} from "@/components/ui/label/index.js";
import {computed, nextTick, ref, watch} from "vue";
import { PencilIcon } from 'lucide-vue-next';
import BaseFormField from "@/components/sb/form/shared/BaseFormField.vue";
import {useFieldError} from "vee-validate";
import {getErrorMessages, toBracketNotation} from "@/lib/utils.js";
import {FieldError} from "@/components/ui/field/index.js";

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
    errorName: {
        type: String,
    },
    modelValue: {
        type: String,
        required: true,
        default: 't',
    }
})

const emits = defineEmits(["update:modelValue"])

const value = computed({
    get: () => props.modelValue,
    set: (value) => emits('update:modelValue', value)
})

const defaultValue = ref(value.value || '-')
const isEditing = ref(false)
const inputRef = ref(null)

const errorMessage = useFieldError(toBracketNotation(props.errorName));

watch(isEditing, async (nV) => {
    if (nV) {
        await nextTick()
        inputRef.value?.focus()
    }

    if (!nV && !String(value.value).trim()) {
        value.value = defaultValue.value
    }
})
</script>

<template>
    <div class="group relative min-w-0">
        <Label
            v-if="!isEditing"
            class="
              text-sm font-medium tracking-tight
              cursor-pointer rounded-md px-2 py-1
              transition-all duration-200
              flex items-center gap-1.5
            "
            :class="[
                errorMessage ? 'text-destructive bg-accent/40 ring-1 ring-inset ring-destructive/40'
                : 'text-foreground hover:bg-accent text-accent-foreground ring-1 ring-inset ring-muted-foreground/20'
            ]"
            @click="isEditing = true"
        >
            <span class="truncate">{{ value }}</span>
            <PencilIcon class="h-3 w-3 opacity-50 transition-opacity" />
        </Label>

        <BaseFormField :name="name">
            <template v-slot="{ field, errors }">
                <div v-show="isEditing" class="flex items-center py-1 gap-1 min-w-[50px] w-full max-w-full">
                    <input
                        ref="inputRef"
                        :name="field.name"
                        v-model="value"
                        class="text-sm font-medium tracking-light w-full focus:outline-none focus:ring-0"
                        :class="{'text-destructive' : errorMessage, 'text-foreground' : !errorMessage }"
                        @blur="isEditing = false"
                        @keyup.escape="isEditing = false"
                    />

                    <div class="flex items-center gap-0.5 text-muted-foreground">
                        <span class="text-xs border rounded px-1 bg-muted">ESC</span>
                    </div>
                </div>
            </template>

            <template #error>
                <FieldError :errors="[{message: errorMessage}]" />
            </template>
        </BaseFormField>
    </div>
</template>
