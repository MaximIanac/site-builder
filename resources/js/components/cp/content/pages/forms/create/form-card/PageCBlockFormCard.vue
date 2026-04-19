<script setup>
import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card/index.js";
import CBlockFormContainer from "@/components/cp/content/pages/blocks/cblock/CBlockFormContainer.vue";

const props = defineProps({
    cblocks: {
        type: Array,
        default: () => ([]),
    }
})
</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle class="text-base">Content Blocks</CardTitle>
        </CardHeader>

        <CardContent class="space-y-4">
            <CBlockFormContainer />
        </CardContent>
    </Card>
</template>
