<script setup>
import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card/index.js";
import {
    FieldGroup,
} from '@/components/ui/field'
import LocalizedGroup from "@/components/sb/form/localized/LocalizedGroup.vue";
import FormInput from "@/components/sb/form/shared/FormInput.vue";
import useConfig from "@/composables/useConfig.js";

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

                <LocalizedGroup
                    :locales="useConfig().APP_LOCALES"
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
                            placeholder: 'Enter short description'
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
            </FieldGroup>
        </CardContent>
    </Card>
</template>

<style scoped>

</style>
