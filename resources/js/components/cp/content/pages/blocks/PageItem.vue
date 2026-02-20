<script setup>
import { Link } from '@inertiajs/vue3'
import {Badge} from "@/components/ui/badge/index.ts";

defineProps({
    page: {
        type: Object,
        required: true,
    }
})
</script>

<template>
    <Link
        href=""
        class="flex items-center justify-between py-2 px-3 bg-secondary shadow-md rounded-lg hover:shadow-lg transition-colors"
    >
        <div class="flex items-center gap-6">
            <span class="relative flex w-2 h-2">
                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
            </span>

            <h6 class="text-foreground font-semibold">
                {{ page.title }}
            </h6>

            <Badge class="bg-primary/55 font-mono">{{ page.slug }}</Badge>
        </div>

        <div class="text-sm uppercase font-mono text-muted-foreground">
            <span>MAIN PAGE</span>
        </div>
    </Link>
</template>
