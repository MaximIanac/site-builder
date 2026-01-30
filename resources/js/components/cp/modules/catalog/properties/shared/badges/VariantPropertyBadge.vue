<script setup>
import {Badge} from "@/components/ui/badge/index.ts";
import {Check} from "lucide-vue-next";
import {computed, ref} from "vue";

const emits = defineEmits(['toggle'])
const props = defineProps({
    property: {
        type: Object,
        required: true,
    },
    isPicked: {
        type: Boolean,
        required: true,
    }
})
</script>

<template>
    <div class="relative inline-flex items-center min-h-[24px]">
        <div
            class="absolute left-1 flex items-center justify-center transition-all duration-150 ease-out"
            :class="[
                isPicked
                    ? 'opacity-100 w-5'
                    : 'opacity-0 w-0 overflow-hidden'
            ]"
        >
            <div class="relative">
                <Check class="h-3.5 w-3.5 text-green-600" />
            </div>
        </div>

        <Badge
            variant="secondary"
            :class="[
                'relative border group cursor-pointer transition-all duration-150 ease-out overflow-hidden',
                isPicked
                    ? 'pl-6 border-green-500/20'
                    : 'px-3 border-transparent',
                isPicked
                    ? 'hover:bg-green-600/20 bg-green-500/20 text-green-500'
                    : 'hover:bg-green-500/20 hover:text-green-500'
            ]"
        >
            <span>
                <span v-if="property.is_required" class="text-destructive mr-1 relative z-10">*</span>
                <span class="font-medium truncate max-w-[120px] relative z-10">
                    {{ property.name }}
                </span>
                <span class="text-muted-foreground text-xs ml-1 font-mono lowercase relative z-10">
                    {{ property.code }}
                </span>
            </span>
        </Badge>
    </div>
</template>

<style scoped>

</style>
