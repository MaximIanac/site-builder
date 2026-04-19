<script setup>
import { Link } from '@inertiajs/vue3'
import { Badge } from "@/components/ui/badge/index.ts"
import { Eye, Edit2, ExternalLink } from 'lucide-vue-next'
import pages from "@/routes/cp/pages/index.js";
import {
    Item,
    ItemHeader,
} from '@/components/ui/item'
import ItemActions from "@/components/ui/item/ItemActions.vue";

defineProps({
    page: {
        type: Object,
        required: true,
    }
})
</script>

<template>
    <Item variant="outline" size="sm" as-child>
        <div class="flex items-center justify-between">
            <ItemHeader class="basis-auto justify-start gap-4">
                <span class="relative flex w-2 h-2">
                    <span
                        class="relative inline-flex rounded-full h-2 w-2 transition-all duration-300"
                        :class="page.is_active
                            ? 'bg-emerald-500 shadow-lg shadow-emerald-500/50 ring-2 ring-emerald-500/20'
                            : 'bg-gray-400 dark:bg-neutral-500'"
                    >
                        <span
                            v-if="page.is_active"
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-15"
                        ></span>
                    </span>
                </span>

                {{ page.title }}

                <Badge variant="accent">
                    /{{ page.slug }}
                </Badge>
            </ItemHeader>
            <ItemActions>
                <Link
                    :href="pages.show(page.slug)"
                    class="flex items-center gap-1.5 px-2.5 py-1.5 text-xs font-medium rounded-md bg-background hover:bg-gray-100 dark:hover:bg-neutral-800 transition-colors"
                    target="_blank"
                >
                    <Eye class="h-3.5 w-3.5" />
                    <span>View</span>
                </Link>

                <Link
                    :href="pages.edit(page.slug)"
                    class="flex items-center gap-1.5 px-2.5 py-1.5 text-xs font-medium rounded-md bg-purple-500/10 text-purple-700 dark:text-purple-400 hover:bg-purple-500/20 transition-colors"
                >
                    <Edit2 class="h-3.5 w-3.5" />
                    <span>Edit</span>
                </Link>

                <button
                    @click="$emit('copyLink', page.slug)"
                    class="flex items-center gap-1.5 px-2.5 py-1.5 text-xs font-medium rounded-md bg-background hover:bg-gray-100 dark:hover:bg-neutral-800 transition-colors"
                    title="Копировать ссылку"
                >
                    <ExternalLink class="h-3.5 w-3.5" />
                    <span>Link</span>
                </button>
            </ItemActions>
        </div>
    </Item>
</template>
