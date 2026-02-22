<script setup>
import ControlPanelLayout from "@/layouts/cp/ControlPanelLayout.vue";
import {Head} from "@inertiajs/vue3";
import pages from "@/routes/cp/pages/index.js";
import {Button} from "@/components/ui/button/index.js";
import PageCreateForm from "@/components/cp/content/pages/forms/create/PageCreateForm.vue";

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
        <div class="mx-auto space-y-8">
            <div class="text-end">
                <Button>
                    Create
                </Button>
            </div>

            <PageCreateForm />
        </div>
    </ControlPanelLayout>
</template>
