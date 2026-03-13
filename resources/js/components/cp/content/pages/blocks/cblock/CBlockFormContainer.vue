<script setup>
import CBlockForm from "@/components/cp/content/pages/blocks/cblock/CBlockForm.vue";
import Button from "@/components/ui/button/Button.vue";
import { Plus } from 'lucide-vue-next';
import {useFieldArray} from "vee-validate";
import Slider from "@/components/cp/content/pages/blocks/cblock/sliderEntry/Slider.vue";

const emits = defineEmits(['update:create-cblock'])

const { fields: cblocks, push, update } = useFieldArray("cblocks");

const createCBlock = () => {
    push({
        key: `content_block_${cblocks.value.length + 1}`,
        is_active: false,
        entries: [],
    })
}
</script>

<template>
    <div class="flex flex-col gap-4">
        <CBlockForm
            v-for="(cblock, index) in cblocks"
            :cblock="cblock.value"
            :name="`cblocks.${index}`"
        />

        <Button type="button" @click="createCBlock" variant="outline" class="w-full">
            <Plus /> new content block
        </Button>
    </div>
</template>
