<script setup>
import {Popover, PopoverTrigger} from "@/components/ui/popover/index.js";
import {Command, CommandEmpty, CommandGroup, CommandInput, CommandItem, CommandList} from "@/components/ui/command/index.js";
import {computed, ref} from "vue";

const props = defineProps({
    options: Array,
    fieldMap: Object,
    placeholder: String,
})
const emit = defineEmits(['select:option'])

const selectedOption = ref('');
const open = ref(false);

const mappedOptions = computed(() => props.items.map(item => ({
    label: item[props.fieldMap.label],
    value: item[props.fieldMap.value],
})))


</script>

<template>
    <Popover v-model:open="open">
        <PopoverTrigger as-child>
            <Button
                variant="outline"
                size="sm"
                class="w-[150px] justify-start"
            >
                <template v-if="selectedOption">
                    {{ selectedOption?.label }}
                </template>
                <template v-else>
                    {{ placeholder }}
                </template>
            </Button>
        </PopoverTrigger>
        <PopoverContent class="p-0" side="right" align="start">
            <Command>
                <CommandInput placeholder="Search..." />
                <CommandList>
                    <CommandEmpty>No results found.</CommandEmpty>
                    <CommandGroup>
                        <CommandItem
                            v-for="option in mappedOptions"
                            :key="option.value"
                            :value="option.value"
                            @select="() => {
                                selectedOption = option
                                emit('select:option', option)
                                open = false
                            }"
                        >
                            {{ option.label }}
                        </CommandItem>
                    </CommandGroup>
                </CommandList>
            </Command>
        </PopoverContent>
    </Popover>
</template>

<style scoped>

</style>
