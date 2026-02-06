<script setup>
import ControlPanelLayout from "@/layouts/cp/ControlPanelLayout.vue";
import {Head} from "@inertiajs/vue3";
import catalog from "@/routes/cp/modules/catalog/index.js";
import products from "@/routes/cp/modules/catalog/products/index.js";
import ProductCreateEditForm from "@/components/cp/modules/catalog/products/forms/create/ProductCreateEditForm.vue";

const props = defineProps({
    categories: Array,
    product: Object,
})

const breadcrumbs = [
    {
        title: 'Catalog',
        href: catalog.index(),
    },
    {
        title: props.product.name + ' edit',
        href: products.edit(props.product.slug),
    },
];
</script>

<template>
    <Head title="Product edit" />

    <ControlPanelLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto space-y-8">
            <ProductCreateEditForm
                :categories="categories"
                :product="product"
                :button-label="`Edit ${product.name}`"
            />
        </div>
    </ControlPanelLayout>
</template>
