<script setup>
import ControlPanelLayout from "@/layouts/cp/ControlPanelLayout.vue";
import {Head} from "@inertiajs/vue3";
import pages from "@/routes/cp/pages/index.js";
import PageCreateEditForm from "@/components/cp/content/pages/forms/create/PageCreateEditForm.vue";

const breadcrumbs = [
    {
        title: 'Pages',
        href: pages.index(),
    },
    {
        title: 'Create',
        href: pages.create(),
    },
];
</script>

<template>
    <Head title="Pages" />

    <ControlPanelLayout :breadcrumbs="breadcrumbs">
        <PageCreateEditForm form-type="create" />
    </ControlPanelLayout>
</template>
