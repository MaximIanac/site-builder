<script setup lang="ts">
import ControlPanelSidebarLayout from "@/layouts/cp/partials/ControlPanelSidebarLayout.vue";
import { Toaster } from 'vue-sonner'
import 'vue-sonner/style.css'

defineProps({
    breadcrumbs: {
        type: Array,
        default: () => []
    }
})
</script>

<template>
    <ControlPanelSidebarLayout :breadcrumbs="breadcrumbs">
        <Toaster theme="system" :expand="true" richColors />
        <div class="p-4 h-full">
            <slot />
        </div>
    </ControlPanelSidebarLayout>
</template>
