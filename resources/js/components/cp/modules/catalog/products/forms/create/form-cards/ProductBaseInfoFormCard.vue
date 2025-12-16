<script setup>
import {Button} from "@/components/ui/button/index.js";
import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card/index.js";
import {
    Field, FieldDescription,
    FieldError,
    FieldGroup,
    FieldLabel,
} from '@/components/ui/field'
import { Field as VeeField } from 'vee-validate'
import {X} from "lucide-vue-next";
import ListPopover from "@/components/sb/popover/ListPopover.vue";
import LocalizedGroup from "@/components/sb/form/localized/LocalizedGroup.vue";
import {Input} from "@/components/ui/input/index.js";
import FormInput from "@/components/sb/form/elements/FormInput.vue";

const props = defineProps({
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
                <FormInput
                    name="slug"
                    label="Slug"
                    placeholder="Enter the product unique slug"
                    description="Unique product slug"
                />

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
                                    placeholder: 'Enter name'
                                },
                                {
                                    type: 'input',
                                    name: 'short_description',
                                    label: 'Short Description',
                                    placeholder: 'Enter short description',
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
