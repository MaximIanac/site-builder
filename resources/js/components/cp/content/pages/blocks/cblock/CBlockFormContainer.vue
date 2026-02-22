<script setup>
import {ref} from "vue";
import CBlockForm from "@/components/cp/content/pages/blocks/cblock/CBlockForm.vue";
import Button from "@/components/ui/button/Button.vue";
import { Plus } from 'lucide-vue-next';

const cblocks = ref([]);

const createCBlock = () => {
    cblocks.value.push({
        key: `content_block_${cblocks.value.length + 1}`,
        is_active: false,
        entries: [],
    })
}
</script>

<template>
    <div class="flex flex-col gap-4">
        <CBlockForm v-for="cblock in cblocks" :cblock="cblock" />

        <Button @click="createCBlock" variant="outline" class="w-full">
            <Plus /> new content block
        </Button>
    </div>
</template>
