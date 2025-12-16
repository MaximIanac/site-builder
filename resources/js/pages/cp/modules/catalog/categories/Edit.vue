<script setup>
import {Head} from '@inertiajs/vue3';
import ControlPanelLayout from "@/layouts/cp/ControlPanelLayout.vue";
import EditCategoryForm from "@/components/cp/modules/catalog/categories/forms/create/CategoryCreateEditForm.vue";

const props = defineProps({
    category: Object,
    categories: Array,
    properties: Array,
})

const breadcrumbs = [
    {
        title: 'Catalog',
        href: route('cp.modules.catalog.index'),
    },
    {
        title: props.category.name + ' edit',
        href: route('cp.modules.catalog.categories.create'),
    },
];
</script>

<template>
    <Head :title="category.name + ' edit'" />

    <ControlPanelLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto space-y-8">
            <EditCategoryForm
                :category="category"
                :categories="categories"
                :properties="properties"
            />
        </div>
    </ControlPanelLayout>
</template>
