<script setup>
import { VueDraggableNext as draggable } from 'vue-draggable-next'
import {Plus} from "lucide-vue-next";
import Button from "@/components/ui/button/Button.vue";
import CBlockFormEntry from "@/components/cp/content/pages/blocks/cblock/CBlockFormEntry.vue";
import {computed, ref, watch} from "vue";
import BaseDropdown from "@/components/sb/dropdown/BaseDropdown.vue";
import {CBlockEntryType} from "@/enums/CBlockEntryType.js";
import useConfig from "@/composables/useConfig.js";
import LocalizedGroup from "@/components/sb/form/localized/LocalizedGroup.vue";
import {useFieldArray, useFieldError, useFormErrors} from "vee-validate";
import { GripVertical } from 'lucide-vue-next';
import {FieldError} from "@/components/ui/field/index.js";
import {toBracketNotation} from "@/lib/utils.js";

const props = defineProps({
    cblock: {
        type: Object,
        required: true
    },
    name: {
        type: String,
        required: true
    }
})
const emits = defineEmits([])

const { update, remove, push } = useFieldArray(`${props.name}.entries`)
const errorMessage = useFieldError(`${toBracketNotation(props.name)}.entries`);

const cblockData = computed(() => props.cblock)

const removeEntry = (entryIndex) => {
    remove(entryIndex)
}

const putEntry = (entryIndex, entry) => {
    update(entryIndex, entry)
}

const createEntry = (type) => {
    push({
        key: `${type}_${cblockData.value.entries.length + 1}`,
        type: type,
        value: {},
        slides: type === CBlockEntryType.SLIDER ? [] : null
    })
}

</script>

<template>
    <div class="w-full space-y-4">
        <LocalizedGroup
            :group-title="cblockData.key"
            :locales="useConfig().APP_LOCALES"
        >
            <template v-slot="{ locale }">
                <div class="flex flex-wrap gap-4 -mx-2">
                    <FieldError :errors="[{message: errorMessage}]" />

                    <draggable
                        v-if="!!cblockData.entries.length"
                        v-model="cblockData.entries"
                        item-key="key"
                        class="w-full space-y-2"
                        handle=".drag-handle"
                    >
                        <div
                            class="flex gap-2"
                            v-for="(entry, index) in cblockData.entries"
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

                                @update:entry="(updated) => putEntry(index, updated)"
                                @remove:entry="removeEntry(index)"
                            />
                        </div>
                    </draggable>

                    <BaseDropdown
                        :items="Object.values(CBlockEntryType)"
                        :on-select="createEntry"
                    >
                        <template #trigger>
                            <Button type="button" variant="secondary" class="w-full h-16">
                                <div class="flex flex-col gap-2 items-center justify-center">
                                    <Plus />
                                    <span class="text-muted-foreground text-xs">new entry</span>
                                </div>
                            </Button>
                        </template>
                    </BaseDropdown>
                </div>
            </template>
        </LocalizedGroup>
    </div>
</template>
