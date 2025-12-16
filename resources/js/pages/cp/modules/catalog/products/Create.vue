<script setup>
import ControlPanelLayout from "@/layouts/cp/ControlPanelLayout.vue";
import {Head} from "@inertiajs/vue3";
import catalog from "@/routes/cp/modules/catalog/index.js";
import products from "@/routes/cp/modules/catalog/products/index.js";
import ProductCreateEditForm from "@/components/cp/modules/catalog/products/forms/create/ProductCreateEditForm.vue";

const breadcrumbs = [
    {
        title: 'Catalog',
        href: catalog.index(),
    },
    {
        title: 'Product Create',
        href: products.create(),
    },
];

const props = defineProps({
    categories: Array,
    offer_properties: Array,
})
</script>

<template>
    <Head title="Product create" />

    <ControlPanelLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto space-y-8">
            <ProductCreateEditForm
                :categories="categories"
                :offer_properties="offer_properties"
            />
        </div>
    </ControlPanelLayout>
</template>
