<script setup>
import ControlPanelContent from '@/components/cp/layout/ControlPanelContent.vue';
import ControlPanelShell from '@/components/cp/layout/ControlPanelShell.vue';
import ControlPanelSidebar from '@/components/cp/layout/ControlPanelSidebar.vue';
import ControlPanelSidebarHeader from '@/components/cp/layout/ControlPanelSidebarHeader.vue';

defineProps({
    breadcrumbs: {
        type: Array,
        default: () => []
    }
})
</script>

<template>
    <ControlPanelShell variant="sidebar" class="min-h-screen">
        <ControlPanelSidebar />
        <ControlPanelContent variant="sidebar" class="overflow-x-hidden">
            <ControlPanelSidebarHeader :breadcrumbs="breadcrumbs" />
            <slot />
        </ControlPanelContent>
    </ControlPanelShell>
</template>
