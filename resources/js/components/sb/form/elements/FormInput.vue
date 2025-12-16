<script setup>
import {Input} from "@/components/ui/input/index.ts";
import BaseFormField from "@/components/sb/form/elements/BaseFormField.vue";

</script>

<template>
    <BaseFormField v-bind="$props">
        <template #default="{ field, placeholder, errors }">
            <Input
                :id="field.name"
                v-bind="{
                    ...field,
                    ...$attrs,
                }"
                :placeholder="placeholder"
                :aria-invalid="!!errors.length"
            />
        </template>
    </BaseFormField>

<!--    <VeeField v-slot="{ field, errors, meta }" :name="name" :rules="rules" :label="label">-->
<!--        <Field :data-invalid="!!errors.length">-->
<!--            <FieldLabel v-if="label" :for="field.name">-->
<!--                {{ label }}-->
<!--            </FieldLabel>-->
<!--            <slot :field="field" :errors="errors" :meta="meta">-->
<!--                &lt;!&ndash; Default slot &ndash;&gt;-->
<!--                <Input-->
<!--                    :id="field.name"-->
<!--                    v-bind="field"-->
<!--                    :placeholder="placeholder"-->
<!--                    :aria-invalid="!!errors.length"-->
<!--                />-->
<!--            </slot>-->
<!--            <FieldError :errors="getErrorMessages(errors)" />-->
<!--            <FieldDescription v-if="description">-->
<!--                {{ description }}-->
<!--            </FieldDescription>-->
<!--        </Field>-->
<!--    </VeeField>-->
</template>

<style scoped>

</style>
