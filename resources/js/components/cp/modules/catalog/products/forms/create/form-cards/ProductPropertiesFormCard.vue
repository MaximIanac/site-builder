<script setup>
import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card";
import ListPopover from "@/components/sb/popover/ListPopover.vue";
import {Button} from "@/components/ui/button";
import {FieldGroup} from "@/components/ui/field";
import BaseFormField from "@/components/sb/form/elements/BaseFormField.vue";
import {X} from "lucide-vue-next";
import FormInput from "@/components/sb/form/elements/FormInput.vue";

const props = defineProps({
    properties: {
        type: Array,
        required: true,
    }
})
</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle class="text-base">Properties</CardTitle>
        </CardHeader>

        <CardContent>
            <FieldGroup>
                <template v-for="property in properties">
                    <FormInput
                        v-if="property.type === 'string'"
                        :name="property.code"
                        :label="property.name"
                    />
                </template>
            </FieldGroup>
        </CardContent>
    </Card>
</template>

<style scoped>

</style>
