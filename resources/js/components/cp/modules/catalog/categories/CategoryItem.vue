<script setup>
import { ref, computed } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import CategoryChildrenList from "@/components/cp/modules/catalog/categories/CategoryChildrenList.vue";

const props = defineProps({
    category: {
        type: Object,
    },
    chosenCategory: {
        type: String,
        default: ''
    },
    level: {
        type: Number,
        default: () => 1
    }
})

</script>

<template>
    <div class="relative group">
        <div
            class="flex justify-between items-center gap-2 bg-bg-primary border-2 rounded-lg cursor-pointer min-w-[50px]"
            :class="[
                chosenCategory === category.slug
                    ? 'border-accent-thirdly'
                    : 'border-transparent',
            ]"
        >
            <div class="flex items-center gap-2">
                <CategoryChildrenList :category="category" />
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
