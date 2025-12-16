<script setup>
import {Checkbox} from "@/components/ui/checkbox/index.ts";
import {ChevronRight, SquarePen} from "lucide-vue-next";
import {edit} from "@/routes/cp/modules/catalog/categories/index.ts";
import {Link} from "@inertiajs/vue3";
import { Button } from "@/components/ui/button/index.ts"

const props = defineProps({
    modelValue: {
        type: [Boolean,String],
        required: true,
    },
    category: {
        type: Object,
        required: true,
    },
    open: {
        type: Boolean,
        required: true,
    },
    showArrow: {
        type: Boolean,
        default: true,
    }
})
defineEmits(["change"])

</script>

<template>
    <Button variant="outline" class="flex gap-2 items-center text-sm font-medium truncate py-1 cursor-pointer">
        <div @click.stop class="flex items-center">
            <Checkbox
                class="cursor-pointer"
                :model-value="modelValue"
                @click="($event) => $emit('change', $event)"
            />
        </div>

        {{ category.name }}

        <Link
            @click.stop
            :href="edit(category.slug)"
            :title="`Edit ${category.name}`"
            class="text-blue-500 hover:text-blue-400 rounded-lg transition-all duration-200"
        >
            <SquarePen class="w-4 h-4" />
        </Link>

        <ChevronRight
            v-if="showArrow"
            class="w-5 h-5 transform transition-transform duration-200"
            :class="{'rotate-90': open }"
        />
    </Button>
</template>

<style scoped>

</style>
