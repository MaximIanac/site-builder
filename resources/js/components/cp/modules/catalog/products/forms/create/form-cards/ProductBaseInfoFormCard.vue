<script setup>
import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card/index.js";
import {
    FieldGroup,
} from '@/components/ui/field'
import LocalizedGroup from "@/components/sb/form/localized/LocalizedGroup.vue";
import FormInput from "@/components/sb/form/shared/FormInput.vue";
import useConfig from "@/composables/useConfig.js";
import {useField} from "vee-validate";
import {computed} from "vue";

const { value: slug } = useField("slug")
const { value: name, setValue: setName } = useField("name")
const { value: short_description, setValue: setSDesc } = useField("short_description")
const { value: description, setValue: setDesc } = useField("description")

const localizedData = computed({
    get: () => ({
        name: name,
        short_description: short_description,
        description: description,
    }),
    set: (value) => {
        setName(value.name);
        setSDesc(value.short_description);
        setDesc(value.description);
    }
});
</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle class="text-base">Base Information</CardTitle>
        </CardHeader>

        <CardContent class="space-y-4">
            <FieldGroup>
                <FormInput
                    v-model="slug"
                    name="slug"
                    label="Slug"
                    placeholder="Enter the product unique slug"
                    description="Unique product slug"
                />

                <LocalizedGroup
                    :locales="useConfig().APP_LOCALES"
                    v-model="localizedData"
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
