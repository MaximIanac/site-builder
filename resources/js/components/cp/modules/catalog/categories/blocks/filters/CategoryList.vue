<script setup>
import {
    Card,
    CardContent,
} from '@/components/ui/card/index.ts'
import CategoryItem from "@/components/cp/modules/catalog/categories/blocks/filters/CategoryItem.vue";
import {Button} from "@/components/ui/button/index.ts";
import {router, Link} from "@inertiajs/vue3";
import { SquarePlus } from 'lucide-vue-next';

const props = defineProps({
    categories: {
        type: Array,
        default: () => [],
    }
})

</script>

<template>
    <Card>
        <CardContent class="flex items-start gap-2 p-4">
            <div class="flex items-center flex-wrap gap-2 flex-grow">
                <template v-for="category in categories" :key="category.id">
                    <CategoryItem :category="category" />
                </template>
            </div>

            <Link as-child :href="route('cp.modules.catalog.categories.create')" title="Create new category">
                <Button variant="outline">
                    <SquarePlus />
                    create
                </Button>
            </Link>
        </CardContent>
    </Card>
</template>

<style scoped>

</style>
