<script setup>
import { Button } from '@/components/ui/button'
import {Trash, X} from 'lucide-vue-next';
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from '@/components/ui/popover'
import { ref } from "vue"

const emits = defineEmits(["confirm"])
const open = ref(false)

const close = () => {
    open.value = false
}

const confirm = () => {
    emits('confirm');
    close();
}

</script>

<template>
    <Popover v-model:open="open">
        <PopoverTrigger as-child>
            <slot name="trigger">
                <Trash
                    class="flex-shrink-0 size-4 cursor-pointer text-gray-400 hover:text-red-500 dark:text-gray-500 dark:hover:text-red-500"
                />
            </slot>
        </PopoverTrigger>
        <PopoverContent
            align="end"
            class="w-auto max-w-[300px] px-3 py-2"
        >
            <div class="flex flex-col gap-2">
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    Are you sure you want to delete?
                </p>

                <div class="flex justify-end gap-2">
                    <Button
                        @click="close"
                        class="px-2 !py-0 !text-xs"
                        variant="outline"
                    >
                        <X />
                    </Button>

                    <Button
                        @click="confirm"
                        class="px-2 !py-0 !text-xs"
                        variant="ghost"
                    >
                        <Trash
                            class="flex-shrink-0 size-4 cursor-pointer text-red-500"
                        />
                    </Button>
                </div>
            </div>
        </PopoverContent>
    </Popover>
</template>
