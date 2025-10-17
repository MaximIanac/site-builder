<script setup lang="ts">
import ControlPanelContent from '@/components/cp/layout/ControlPanelContent.vue';
import ControlPanelShell from '@/components/cp/layout/ControlPanelShell.vue';
import ControlPanelHeader from '@/components/cp/layout/ControlPanelHeader.vue';

defineProps({
    breadcrumbs: {
        type: Array,
        default: () => []
    }
})
</script>

<template>
    <ControlPanelShell class="flex-col">
        <ControlPanelHeader :breadcrumbs="breadcrumbs" />
        <ControlPanelContent>
            <slot />
        </ControlPanelContent>
    </ControlPanelShell>
</template>
