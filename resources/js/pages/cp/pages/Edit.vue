<script setup>
import ControlPanelLayout from "@/layouts/cp/ControlPanelLayout.vue";
import {Head} from "@inertiajs/vue3";
import pages from "@/routes/cp/pages/index.js";
import PageCreateForm from "@/components/cp/content/pages/forms/create/PageCreateForm.vue";

const props = defineProps({
    page: {
        type: Object,
        required: true
    }
})

const breadcrumbs = [
    {
        title: 'Pages',
        href: pages.index(),
    },
    {
        title: `${props.page.title} edit`,
        href: pages.edit({page: props.page.id}),
    },
];
</script>

<template>
    <Head :title="page.title" />

    <ControlPanelLayout :breadcrumbs="breadcrumbs">
        <PageCreateForm :page="page" />
    </ControlPanelLayout>
</template>
