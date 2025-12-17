<script setup>
import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card/index.js";
import {Field, FieldError, FieldGroup, FieldLabel} from "@/components/ui/field/index.js";
import ListPopover from "@/components/sb/popover/ListPopover.vue";
import {Button} from "@/components/ui/button/index.js";
import LocalizedGroup from "@/components/sb/form/localized/LocalizedGroup.vue";
import {X} from "lucide-vue-next";
import { Field as VeeField } from 'vee-validate'
import BaseFormField from "@/components/sb/form/elements/BaseFormField.vue";
import {Input} from "@/components/ui/input/index.js";

const emits = defineEmits(['update:category_id'])
const props = defineProps({
    categories: {
        type: Array,
    },
    values: Array,
})

</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle class="text-base">Category</CardTitle>
        </CardHeader>

        <CardContent class="min-w-[200px]">
            <FieldGroup>
                <BaseFormField
                    name="category_id"
                >
                    <template #default="{ field }">
                        <div class="flex items-center gap-4">
                            <ListPopover
                                class="w-full"
                                placeholder="+ category"
                                :options="categories"
                                :field-map="{ label: 'name', value: 'id'}"
                                :model-value="field.value"
                                @update:modelValue="(v) => emits('update:category_id', v)"
                            />

                            <Button
                                v-if="values.category_id"
                                type="button"
                                @click="() => emits('update:category_id', null)"
                                variant="outline"
                                size="sm"
                            >
                                <X class="text-muted-foreground"/>
                            </Button>
                        </div>
                    </template>
                </BaseFormField>
            </FieldGroup>
        </CardContent>
    </Card>
</template>

<style scoped>

</style>
