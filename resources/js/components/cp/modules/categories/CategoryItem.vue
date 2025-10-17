<script setup>
import { ref, computed } from 'vue'
import { Link, router } from '@inertiajs/vue3'

import { Trash2, SquarePen, ChevronRight } from 'lucide-vue-next';
import CategoryChildrenList from "@/components/cp/modules/categories/CategoryChildrenList.vue";
import {DropdownMenuTrigger} from "@/components/ui/dropdown-menu/index.js";
import {Button} from "@/components/ui/button/index.js";

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

const hasChildren = computed(() => {
    return props.category.children && props.category.children.length > 0
})

const submitCategory = () => {
    router.get(route().current(), {
        chosen_category: props.category.slug
    }, {
        preserveState: true,
        preserveScroll: true
    })
}

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
