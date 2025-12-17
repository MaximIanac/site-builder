<script setup>
import {Popover, PopoverTrigger, PopoverContent} from "@/components/ui/popover";
import {Button} from "@/components/ui/button";
import {Command, CommandEmpty, CommandGroup, CommandInput, CommandItem, CommandList} from "@/components/ui/command";
import {computed, ref} from "vue";
import {cn} from "@/lib/utils.js";
import { Check } from 'lucide-vue-next';

const props = defineProps({
    modelValue: Number,
    options: Array,
    fieldMap: Object,
    placeholder: String,
})
const emit = defineEmits(['update:modelValue'])

const open = ref(false);

const mappedOptions = computed(() => props.options.map(item => ({
    label: item[props.fieldMap.label],
    value: item[props.fieldMap.value],
})))

const selectedOption = computed(() => {
    if (!props.modelValue) return null;

    return mappedOptions.value.find(opt => opt.value === props.modelValue) || null;
})
</script>

<template>
    <Popover v-model:open="open">
        <PopoverTrigger as-child>
            <Button
                variant="outline"
                class="flex flex-grow"
            >
                <template v-if="selectedOption">
                    {{ selectedOption?.label }}
                </template>
                <template v-else>
                    {{ placeholder }}
                </template>
            </Button>
        </PopoverTrigger>
        <PopoverContent class="p-0" align="start">
            <Command>
                <CommandInput placeholder="Search..." />
                <CommandList>
                    <CommandEmpty>No results found.</CommandEmpty>
                    <CommandGroup>
                        <CommandItem
                            class="cursor-pointer hover:bg-accent"
                            v-for="option in mappedOptions"
                            :key="option.value"
                            :value="option.value"
                            @select="() => {
                                emit('update:modelValue', option.value)
                                open = false
                            }"
                        >
                            {{ option.label }}

                            <Check
                                :class="cn('ml-auto h-4 w-4', option.value === selectedOption?.value ? 'opacity-100' : 'opacity-0')"
                            />
                        </CommandItem>
                    </CommandGroup>
                </CommandList>
            </Command>
        </PopoverContent>
    </Popover>
</template>

<style scoped>

</style>
