<script setup>
import {Head, usePage} from '@inertiajs/vue3';
import ControlPanelLayout from "@/layouts/cp/ControlPanelLayout.vue";
import CategoryList from "@/components/cp/modules/catalog/categories/blocks/filters/CategoryList.vue";

const breadcrumbs = [
    {
        title: 'Catalog',
        href: route('cp.modules.catalog.index'),
    },
];

const props = defineProps({
    pageData: Object,
})
</script>

<template>
    <Head title="Catalog" />

    <ControlPanelLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto space-y-8">
            <div>
                <CategoryList :categories="pageData.categories" />
<!--                <x-sb.catalog.cp.categories.list :categories="$data->categories" />-->
            </div>

<!--            <div class="flex gap-8">-->
<!--                <div class="flex-1">-->
<!--                    <x-sb.catalog.cp.products.wrapper>-->
<!--                        <x-sb.catalog.cp.products.header />-->
<!--                        <x-sb.catalog.cp.products.list :products="$data->products->items()" />-->
<!--                    </x-sb.catalog.cp.products.wrapper>-->
<!--                </div>-->

<!--                <div class="w-1/5">-->
<!--                    <x-sb.catalog.cp.properties.wrapper>-->
<!--                        <x-sb.catalog.cp.properties.list :properties="$data->properties" />-->
<!--                    </x-sb.catalog.cp.properties.wrapper>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </ControlPanelLayout>
</template>
