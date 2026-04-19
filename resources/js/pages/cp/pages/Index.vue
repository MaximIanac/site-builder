<script setup>
import ControlPanelLayout from "@/layouts/cp/ControlPanelLayout.vue";
import {Head} from "@inertiajs/vue3";
import pages from "@/routes/cp/pages/index.js";
import {Button} from "@/components/ui/button/index.js";
import { Link } from '@inertiajs/vue3'
import PageItem from "@/components/cp/content/pages/blocks/PageItem.vue";

const props = defineProps({
    pagesData: Array,
})

const breadcrumbs = [
    {
        title: 'Pages',
        href: pages.index(),
    },
];

console.log(props.pagesData)
</script>

<template>
    <Head title="Pages" ></Head>

    <ControlPanelLayout :breadcrumbs="breadcrumbs">
        <div class="mx-auto space-y-8">
            <div class="text-end">
                <Button as-child>
                    <Link :href="pages.create()">
                        New Page
                    </Link>
                </Button>
            </div>

            <div>
                <div v-if="pagesData.length > 0">
                    <PageItem v-for="page in pagesData" :page="page" :key="page.id" />
                </div>
                <div v-else class="p-6 bg-bg-secondary rounded-lg text-center">
                    <p class="text-text-secondary text-sm mb-4">
                        No pages available.
                    </p>

                    <Button as-child variant="outline">
                        <Link :href="pages.create()">
                            New Page
                        </Link>
                    </Button>
                </div>
            </div>
        </div>
    </ControlPanelLayout>
</template>
