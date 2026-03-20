<script setup>
import FormInput from "@/components/sb/form/shared/FormInput.vue";
import {computed, reactive, ref, watch, provide} from "vue";
import FormTextarea from "@/components/sb/form/shared/FormTextarea.vue";
import { Trash } from 'lucide-vue-next';
import InlineEditLabel from "@/components/sb/labels/InlineEditLabel.vue";
import Slider from "@/components/cp/content/pages/blocks/cblock/sliderEntry/Slider.vue";
import ConfirmationPopover from "@/components/sb/popover/ConfirmationPopover.vue";
const emits = defineEmits(['update:entry', "remove:entry"])
const props = defineProps({
    entry: {
        type: Object,
        required: true,
    },
    name: {
        type: String,
        required: true,
    },
    locale: {
        type: String,
        required: true,
    },
})

provide('locale', props.locale)

watch(
    () => props.entry,
    (val) => {
        emits('update:entry', val)
    },
    { deep: true }
)
</script>

<template>
    <div class="w-full space-y-1">
        <div class="flex items-center justify-between gap-2">
            <InlineEditLabel
                :name="`${name}.__${locale}`"
                :errorName="`${name}.key`"
                v-model="entry.key"
            />

            <ConfirmationPopover @confirm="$emit('remove:entry', entry.id)" />
        </div>

        <FormInput
            :id="entry.key"
            v-if="entry.type === 'hero'"
            :name="`${name}.value.${locale}`"
            v-model="entry.value[locale]"
        />
        <FormTextarea
            :id="entry.key"
            v-if="entry.type === 'text'"
            :name="`${name}.value.${locale}`"
            v-model="entry.value[locale]"
        />
        <Slider
            :id="entry.key"
            v-if="entry.type === 'slider'"
            :name="`${name}.slides`"
            :slides="entry.slides"
        />
    </div>
</template>
