<script setup>

import {Plus} from "lucide-vue-next";
import Button from "@/components/ui/button/Button.vue";
import CBlockFormEntry from "@/components/cp/content/pages/blocks/cblock/CBlockFormEntry.vue";
import {ref} from "vue";
import BaseDropdown from "@/components/sb/dropdown/BaseDropdown.vue";
import {CBlockEntryType} from "@/enums/CBlockEntryType.js";

const props = defineProps({
    cblock: {
        type: Object,
        required: true
    }
})

const cblockData = ref(props.cblock)

const createEntry = (type) => {
    cblockData.value.entries.push({
        key: `entry_${cblockData.value.entries.length + 1}`,
        type: type,
        value: {},
    })
}

</script>

<template>
    <div class="w-full space-y-4">
        <div class="border-b-2 pb-2 border-neutral-800">
            <span class="text-sm">{{ cblock.key }}</span>
        </div>

        <div class="flex flex-wrap gap-4 ">
            <CBlockFormEntry
                v-for="entry in cblockData.entries"
                :entry="entry"
            />

            <BaseDropdown
                :items="Object.values(CBlockEntryType)"
                :on-select="createEntry"
            >
                <template #trigger>
                    <Button variant="outline" class="w-16 h-16">
                        <div class="flex flex-col gap-2 items-center justify-center">
                            <Plus />
                            <span class="text-muted-foreground text-xs">new entry</span>
                        </div>
                    </Button>
                </template>
            </BaseDropdown>
        </div>
    </div>
</template>

<style scoped>

</style>
