<script setup>
import {
    Card,
    CardContent,
} from '@/components/ui/card'
import CategoryItem from "@/components/cp/modules/categories/CategoryItem.vue";
import {Button} from "@/components/ui/button/index.js";
import {router} from "@inertiajs/vue3";

const props = defineProps({
    categories: {
        type: Array,
        default: () => [],
    }
})

</script>

<template>
    <Card>
        <CardContent class="p-4">
            <div class="flex items-center flex-wrap gap-2">
                <Button
                    class="text-sm font-medium truncate"
                    @click=""
                >
                    All
                </Button>

                <template v-for="category in categories" :key="category.id">
                    <CategoryItem :category="category" />
                </template>
            </div>

            <div class="flex items-center gap-4">
    <!--            <a href="{{route('cp.content.modules.catalog.categories.create')}}" class="p-2 bg-accent-primary rounded-full hover:bg-accent-secondary transition-colors duration-300" title="Add Category">-->
    <!--                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">-->
    <!--                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>-->
    <!--                </svg>-->
    <!--            </a>-->
            </div>
        </CardContent>
    </Card>
</template>

<style scoped>

</style>
