<script setup>
import {Item, ItemContent, ItemHeader} from "@/components/ui/item/index.ts";
import {CBlockEntryType} from "@/enums/CBlockEntryType.js";
import {GripVertical, Plus, Trash} from "lucide-vue-next";
import Button from "../../../../../../ui/button/Button.vue";
import BaseDropdown from "@/components/sb/dropdown/BaseDropdown.vue";
import CBlockFormEntry from "@/components/cp/content/pages/blocks/cblock/CBlockFormEntry.vue";
import {useFieldArray} from "vee-validate";
import {inject} from "vue";
import { VueDraggableNext as draggable } from 'vue-draggable-next'
import ConfirmationPopover from "@/components/sb/popover/ConfirmationPopover.vue";

const props = defineProps({
    slide: {
        type: Object,
        required: true,
    },
    name: {
        type: String,
        required: true,
    },
    index: {
        type: Number,
        required: true,
    },
})
const emits = defineEmits(['remove:slide'])

const locale = inject('locale');
const { update, remove, push } = useFieldArray(`${props.name}.entries`)

const createEntry = (type) => {
    const newEntry = {
        key: `${type}_${props.slide.entries.length + 1}`,
        type: type,
        value: {},
    }

    push(newEntry)
}

const removeEntry = (index) => {

    console.log(index)

    console.log(props.slide)
    remove(index)
}
</script>

<template>
    <Item class="block space-y-2 p-3
        rounded-l-none
        bg-white/80 dark:bg-gray-900/25
        border border-gray-200 dark:border-gray-700/50"
    >
        <ItemHeader
            class="flex justify-between gap-4 pb-2 transition-colors duration-300 border-b border-gray-100 dark:border-gray-700/50"
        >
            <span class="font-medium text-gray-600 dark:text-gray-300">
                <span class="text-indigo-500 dark:text-indigo-400 mr-1">#</span>
                Slide {{ index + 1 }}
            </span>

            <ConfirmationPopover @confirm="$emit('remove:slide', index)" />
        </ItemHeader>

        <ItemContent class="gap-1">
            <draggable
                v-if="!!slide.entries.length"
                v-model="slide.entries"
                item-key="key"
                class="w-full space-y-2"
                handle=".drag-handle"
            >
                <div
                    class="flex gap-1"
                    v-for="(entry, index) in slide.entries"
                    :key="index"
                >
                    <div>
                        <Button type="button" class="drag-handle !px-0.5 !flex h-full" variant="outline">
                            <GripVertical class="size-4" />
                        </Button>
                    </div>

                    <CBlockFormEntry
                        :entry="entry"
                        :name="`${name}.entries.${index}`"
                        :locale="locale"
                        @remove:entry="removeEntry(index)"
                    />
                </div>
            </draggable>

            <BaseDropdown
                :items="Object.values(CBlockEntryType).filter(i => i !== CBlockEntryType.SLIDER)"
                :on-select="createEntry"
            >
                <template #trigger>
                    <Button type="button" variant="secondary" class="w-full h-8">
                        <div class="flex gap-2 items-center justify-center">
                            <Plus />
                            <span class="text-muted-foreground text-xs">new entry</span>
                        </div>
                    </Button>
                </template>
            </BaseDropdown>
        </ItemContent>
    </Item>
</template>
