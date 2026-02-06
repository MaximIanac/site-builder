<script setup>
import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card";
import {FieldGroup} from "@/components/ui/field";
import {computed} from "vue";
import LocalizedGroup from "@/components/sb/form/localized/LocalizedGroup.vue";
import useConfig from "@/composables/useConfig.js";

const props = defineProps({
    properties: {
        type: Array,
        required: true,
        default: () => [],
    }
})
const emits = defineEmits(['update:properties'])

const mappedFields = computed(() => props.properties.map((item, index) => ({
    type: item.type === 'string' ? "input" : 'error',
    name: `properties.${index}.value`,
    label: item.name,
    placeholder: "value of " + String(item.name).toLowerCase(),
})))

const propertyValues = computed({
    get: () =>
        mappedFields.value.reduce((acc, item, index) => ({
            ...acc,
            [item.name]: props.properties[index].value
        }), {}),
    set: (newValues) => {
        const updatedProperties = mappedFields.value.map((item, index) => ({
            ...props.properties[index],
            value: newValues[item.name]
        }));

        console.log(updatedProperties)

        emits("update:properties", updatedProperties);
    }
})
</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle class="text-base">Properties from category</CardTitle>
        </CardHeader>

        <CardContent>
            <FieldGroup>
                <LocalizedGroup
                    v-if="mappedFields.length > 0"
                    v-model="propertyValues"
                    :locales="useConfig().APP_LOCALES"
                    :fields="mappedFields"
                />
                <span v-else class="text-xs text-muted-foreground">Choose category to get properties</span>
            </FieldGroup>
        </CardContent>
    </Card>
</template>
