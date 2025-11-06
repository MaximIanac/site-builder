<script setup>
import {Head, usePage} from '@inertiajs/vue3';
import ControlPanelLayout from "@/layouts/cp/ControlPanelLayout.vue";
import CreateCategoryForm from "@/components/cp/modules/catalog/categories/forms/create/CreateCategoryForm.vue";

const breadcrumbs = [
    {
        title: 'Catalog',
        href: route('cp.modules.catalog.index'),
    },
    {
        title: 'Category Create',
        href: route('cp.modules.catalog.categories.create'),
    },
];

const props = defineProps({
    categories: Array,
    properties: Array,
})
</script>

<template>
    <Head title="Category create" />

    <ControlPanelLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto space-y-8">
            <CreateCategoryForm
                :categories="categories"
                :properties="properties"
            />
        </div>
    </ControlPanelLayout>
</template>
