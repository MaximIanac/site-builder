<script setup>
import CBlockForm from "@/components/cp/content/pages/blocks/cblock/CBlockForm.vue";
import Button from "@/components/ui/button/Button.vue";
import { Plus } from 'lucide-vue-next';
import {useFieldArray} from "vee-validate";

const { fields: cblocks, push, update } = useFieldArray("cblocks");

const createCBlock = () => {
    push({
        key: `content_block_${cblocks.value.length + 1}`,
        is_active: false,
        entries: [],
    })
}

const putCBlock = (index, cblock, is_active) => {
    update(index, {
        ...cblock.value,
        is_active: is_active
    })
}
</script>

<template>
    <div class="flex flex-col gap-4">
        <CBlockForm
            v-for="(cblock, index) in cblocks"
            :name="`cblocks.${index}`"
            :cblock="cblock.value"
            @update:is-active="putCBlock(index, cblock, $event)"
        />

        <Button type="button" @click="createCBlock" variant="outline" class="w-full">
            <Plus /> new content block
        </Button>
    </div>
</template>
