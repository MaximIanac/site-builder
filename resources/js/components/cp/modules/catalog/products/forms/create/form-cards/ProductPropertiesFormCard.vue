<script setup>
import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card";
import {Field, FieldGroup} from "@/components/ui/field";
import FormInput from "@/components/sb/form/shared/FormInput.vue";
import {computed, onMounted, watch} from "vue";
import LocalizedGroup from "@/components/sb/form/localized/LocalizedGroup.vue";
import useConfig from "@/composables/useConfig.js";
import {useFieldArray, useForm} from "vee-validate";

const props = defineProps({
    properties: {
        type: Array,
        required: true,
        default: () => [],
    }
})

const mappedFields = computed(() => props.properties.map((item, index) => ({
    type: item.type === 'string' ? "input" : 'error',
    name: `properties.${index}.value`,
    label: item.name,
    placeholder: "value of " + String(item.name).toLowerCase(),
})))
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
                    :locales="useConfig().APP_LOCALES"
                    :fields="mappedFields"
                />
                <span v-else class="text-xs text-muted-foreground">Choose category to get properties</span>
            </FieldGroup>
        </CardContent>
    </Card>
</template>
