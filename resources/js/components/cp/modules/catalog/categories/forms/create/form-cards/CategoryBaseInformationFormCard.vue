<script setup>
import {Button} from "@/components/ui/button/index.js";
import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card/index.js";
import {FormControl, FormField, FormItem, FormLabel, FormMessage} from "@/components/ui/form/index.js";
import {
    Field,
    FieldDescription,
    FieldError,
    FieldGroup,
    FieldLabel,
} from '@/components/ui/field'
import { Field as VeeField } from 'vee-validate'
import {X} from "lucide-vue-next";
import ListPopover from "@/components/sb/popover/ListPopover.vue";
import LocalizedGroup from "@/components/sb/form/localized/LocalizedGroup.vue";

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

const emit = defineEmits(['update:parent_id', 'update:locales'])

const getErrorMessages = (errors) => {
    return errors.map( error => ({ message: error }));
}
</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle class="text-base">Base Information</CardTitle>
        </CardHeader>

        <CardContent class="space-y-4">
            <FieldGroup>
                <VeeField v-slot="{ field, errors}" name="parent_id">
                    <Field :data-invalid="!!errors.length">
                        <FieldLabel :for="field.name">Parent Category</FieldLabel>
                        <div class="flex items-center gap-4">
                            <ListPopover
                                placeholder="+ category"
                                :options="categories"
                                :field-map="{ label: 'name', value: 'id'}"
                                :model-value="field.value"
                                @update:modelValue="(v) => emit('update:parent_id', v)"
                            />

                            <Button
                                type="button"
                                @click="() => emit('update:parent_id', null)"
                                v-if="values.parent_id"
                                variant="outline"
                                size="sm"
                            >
                                <X class="text-muted-foreground"/>
                            </Button>
                        </div>
                        <FieldError :errors="getErrorMessages(errors)"/>
                    </Field>
                </VeeField>

                <VeeField v-slot="{ field, errors }" name="locales">
                    <Field :data-invalid="!!errors.length">
                        <LocalizedGroup
                            :model-value="field.value"
                            @update:model-value="(v) => emit('update:locales', v)"
                            :locales="['en', 'ru']"
                            :fields="[
                                {
                                    type: 'input',
                                    name: 'name',
                                    label: 'Name',
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
                        <FieldError :errors="getErrorMessages(errors)"/>
                    </Field>
                </VeeField>
            </FieldGroup>
        </CardContent>
    </Card>
</template>

<style scoped>

</style>
