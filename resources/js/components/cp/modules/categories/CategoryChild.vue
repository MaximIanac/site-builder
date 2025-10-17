<script setup>
import { ref, computed } from 'vue'
import { Link, router } from '@inertiajs/vue3'

import { Trash2, SquarePen, ChevronRight } from 'lucide-vue-next';

const props = defineProps({
    category: {
        type: Object,
    },
    chosenCategory: {
        type: String,
        default: ''
    }
})

const open = ref(false)

const hasChildren = computed(() => {
    return props.category.children && props.category.children.length > 0
})

const toggleOpen = () => {
    open.value = !open.value
}

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
    <div
        class="relative group"
        @click="open = false"
    >
        <div
            class="flex justify-between items-center gap-2 p-2 bg-bg-primary border-2 rounded-lg cursor-pointer min-w-[50px]"
            :class="[
                chosenCategory === category.slug
                    ? 'border-accent-thirdly'
                    : 'border-transparent',
                {'rounded-b-none': open}
            ]"
        >
            <div class="flex items-center gap-2">
                <ChevronRight
                    v-if="hasChildren"
                    class="w-5 h-5 text-text-secondary transform transition-transform duration-200"
                    :class="{ 'rotate-90': open }"
                    @click.stop="toggleOpen"
                />

                <form @submit.prevent="submitCategory">
                    <input type="hidden" name="chosen_category" :value="category.slug">
                    <button type="submit" class="text-sm font-medium text-text-primary truncate">
                        {{ category.name }}
                    </button>
                </form>
            </div>

            <div class="flex items-center justify-end">
                <Link
                    :href="route('cp.content.modules.catalog.categories.edit', category.slug)"
                    class="p-1 text-accent-primary hover:text-accent-secondary"
                    :title="`Edit ${category.name}`"
                >
                    <SquarePen />
                </Link>
                <button
                    class="p-1 text-red-400 hover:text-red-500"
                    :title="`Delete ${category.name}`"
                >
                    <Trash2 />
                </button>
            </div>
        </div>

        <div v-if="hasChildren && open">
            <CategoryItem :categories="category.children"/>
        </div>
    </div>
</template>

<style scoped>

</style>
