<script setup>
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'

const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
    onSelect: {
        type: Function,
    }
})

const handleClick = (item) => {
    props.onSelect?.(item)
}
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger class="w-full">
            <slot name="trigger" />
        </DropdownMenuTrigger>
        <DropdownMenuContent align="start">
            <slot name="content">
                <DropdownMenuItem
                    v-for="item in items"
                    :key="item"
                    @click="handleClick(item)"
                >
                    {{ item }}
                </DropdownMenuItem>
            </slot>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
