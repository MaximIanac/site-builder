<script setup lang="ts">
import ControlPanelSidebarLayout from "@/layouts/cp/partials/ControlPanelSidebarLayout.vue";

defineProps({
    breadcrumbs: {
        type: Array,
        default: () => []
    }
})
</script>

<template>
    <ControlPanelSidebarLayout :breadcrumbs="breadcrumbs">
        <div class="p-4 h-full">
            <slot />
        </div>
    </ControlPanelSidebarLayout>
</template>
