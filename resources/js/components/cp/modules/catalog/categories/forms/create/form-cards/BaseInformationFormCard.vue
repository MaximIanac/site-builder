<script setup>
import {Button} from "@/components/ui/button/index.js";
import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card/index.js";
import {FormControl, FormField, FormItem, FormLabel, FormMessage} from "@/components/ui/form/index.js";
import {X} from "lucide-vue-next";
import ListPopover from "@/components/sb/popover/ListPopover.vue";
import LocalizedGroup from "@/components/sb/form-elements/localized/LocalizedGroup.vue";

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
    values: {
        type: Object,
        required: true,
    },
})

const emit = defineEmits(['update:parent_category_id', 'update:locales'])

</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle class="text-base">Base Information</CardTitle>
        </CardHeader>

        <CardContent class="space-y-4">
            <FormField name="parent_category_id">
                <FormItem>
                    <FormLabel>Parent Category</FormLabel>
                    <FormControl>
                        <div class="flex items-center gap-4">
                            <ListPopover
                                placeholder="+ category"
                                :options="categories"
                                :field-map="{ label: 'name', value: 'id'}"
                                :model-value="values.parent_category_id"
                                @update:modelValue="(v) => emit('update:parent_category_id', v)"
                            />

                            <Button
                                @click="() => emit('update:parent_category_id', null)"
                                v-if="values.parent_category_id"
                                variant="outline"
                                size="sm"
                            >
                                <X class="text-muted-foreground"/>
                            </Button>
                        </div>
                    </FormControl>
                    <FormMessage />
                </FormItem>
            </FormField>
            <FormField name="locales">
                <FormItem>
                    <FormControl>
                        <LocalizedGroup
                            :model-value="values.locales"
                            @update:model-value="(v) => emit('update:locales', v)"
                            :locales="['en', 'ru']"
                            :fields="[
                                {
                                    type: 'input',
                                    name: 'title',
                                    label: 'Title',
                                    placeholder: 'Enter title'
                                },
                                {
                                    type: 'textarea',
                                    name: 'description',
                                    label: 'Description',
                                    placeholder: 'Enter description',
                                    rows: 4
                                }
                            ]"
                        />
                    </FormControl>
                    <FormMessage />
                </FormItem>
            </FormField>
        </CardContent>
    </Card>
</template>

<style scoped>

</style>
