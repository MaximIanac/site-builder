<script setup>
import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card/index.js";
import { FieldGroup } from '@/components/ui/field'
import LocalizedGroup from "@/components/sb/form/localized/LocalizedGroup.vue";
import FormInput from "@/components/sb/form/shared/FormInput.vue";
import useConfig from "@/composables/useConfig.js";
import {useField} from "vee-validate";
import {computed} from "vue";

const { value: slug } = useField("slug")
const { value: title, setValue: setTitle } = useField("title")

const localizedData = computed({
    get: () => ({ title: title }),
    set: (value) => setTitle(value.title)
})
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
                    placeholder="Enter the page unique slug (route)"
                    description="Unique page slug"
                />

                <LocalizedGroup
                    :locales="useConfig().APP_LOCALES"
                    v-model="localizedData"
                    :fields="[
                        {
                            type: 'input',
                            name: 'title',
                            label: 'Title',
                            placeholder: 'Enter page title'
                        },
                    ]"
                />
            </FieldGroup>
        </CardContent>
    </Card>
</template>

<style scoped>

</style>
