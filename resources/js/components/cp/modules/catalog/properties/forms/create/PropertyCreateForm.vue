<script setup>
import * as z from "zod"
import { Button } from "@/components/ui/button"
import { useForm, Field as VeeField } from 'vee-validate'
import {
    Field,
    FieldDescription,
    FieldError,
    FieldGroup,
    FieldLabel,
} from '@/components/ui/field'
import { Spinner } from '@/components/ui/spinner'
import { Input } from "@/components/ui/input"
import LocalizedGroup from "@/components/sb/form/localized/LocalizedGroup.vue";
import useAjax from "@/composables/useAjax.js";
import {PropertyUsageType} from "@/enums/PropertyUsageType.js";
import {toTypedSchema} from "@vee-validate/zod";
import { toast } from 'vue-sonner'
import {Check} from "lucide-vue-next";

const emits = defineEmits(['created:property'])

const ajax = useAjax();

const createPropertySchema = toTypedSchema(z.object({
    code: z.string().min(2),
    locales: z.object({
        name: z.record(z.string(), z.string()),
    }),
    type: z.string()
}));

const { handleSubmit, setFieldValue, isSubmitting, setErrors } = useForm({
    validationSchema: createPropertySchema,
    initialValues: {
        type: 'string',
    },
})

const onSubmit = handleSubmit( async (data) => {
    await ajax.post(
        route('api.cp.modules.catalog.properties.store'),
        data
    )

    if (ajax.state.errors) {
        setErrors(ajax.state.errors);
        toast.error("Property has not created")
        return;
    }

    toast.success("Property has created")
    emits('created:property', ajax.state.data)
})

const getErrorMessages = (errors) => {
    return errors.map( error => ({ message: error }));
}
</script>

<template>
    <form id="create-property" @submit="onSubmit" class="space-y-4">
        <FieldGroup>
            <VeeField v-slot="{ field, errors }" name="code">
                <Field :data-invalid="!!errors.length">
                    <FieldLabel :for="field.name">Code</FieldLabel>
                    <Input
                        :id="field.name"
                        v-bind="field"
                        placeholder="property_code"
                        :aria-invalid="!!errors.length"
                    />
                    <FieldError :errors="getErrorMessages(errors)"/>
                    <FieldDescription class="text-xs">Unique property ID. Use lowercase with underscores</FieldDescription>
                </Field>
            </VeeField>

            <VeeField v-slot="{ field, errors }" name="locales">
                <Field :data-invalid="!!errors.length">
                    <LocalizedGroup
                        :id="field.name"
                        :name="field.name"
                        :model-value="field.value"
                        @update:model-value="(v) => setFieldValue('locales', v)"
                        :locales="['en', 'ru']"
                        :fields="[
                            {
                                type: 'input',
                                name: 'name',
                                label: 'Name',
                                placeholder: 'Enter name'
                            },
                        ]"
                    />
                    <FieldError :errors="getErrorMessages(errors)"/>
                    <FieldDescription class="text-xs">This is public display property name.</FieldDescription>
                </Field>
            </VeeField>

            <Field orientation="horizontal" class="justify-end">
                <Button
                    type="submit"
                    form="create-property"
                    :disabled="ajax.state.loading"
                >
                    {{ ajax.state.loading ? 'Processing..' : 'Create' }}
                    <Spinner v-if="ajax.state.loading" />
                </Button>
            </Field>
        </FieldGroup>
    </form>
</template>

