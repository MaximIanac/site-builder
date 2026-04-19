<script setup>
import ControlPanelLayout from "@/layouts/cp/ControlPanelLayout.vue";
import {Head} from "@inertiajs/vue3";
import pages from "@/routes/cp/pages/index.js";
import PageCreateEditForm from "@/components/cp/content/pages/forms/create/PageCreateEditForm.vue";

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
        title: `${props.page.title} (/${props.page.slug}) edit`,
        href: pages.edit({page: props.page.id}),
    },
];
</script>

<template>
    <Head :title="page.title" />

    <ControlPanelLayout :breadcrumbs="breadcrumbs">
        <PageCreateEditForm :page="page" form-type="edit" />
    </ControlPanelLayout>
</template>
