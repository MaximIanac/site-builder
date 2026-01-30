<script setup>
import { CirclePlus } from 'lucide-vue-next';
import { Button } from "@/components/ui/button"
import {PropertyUsageType} from "@/enums/PropertyUsageType.js";
import BaseDialog from "@/components/sb/dialogs/BaseDialog.vue";
import PropertyCreateForm from "@/components/cp/modules/catalog/properties/forms/create/PropertyCreateForm.vue";

const emits = defineEmits(['created:property'])
const props = defineProps({
    usage_type: {
        type: String,
        validator: (v) => Object.values(PropertyUsageType).includes(v),
        required: true,
    }
})
</script>

<template>
    <BaseDialog title="Property">
        <template #trigger>
            <Button variant="outline" size="sm">
                <CirclePlus />
                Create new property
            </Button>
        </template>

        <template #content>
            <PropertyCreateForm
                @created:property="($event) => emits('created:property', $event)"
            />
        </template>
    </BaseDialog>

<!--    <Dialog>-->
<!--        <DialogTrigger as-child>-->
<!--            <Button variant="outline" size="sm">-->
<!--                <CirclePlus />-->
<!--                Create new property-->
<!--            </Button>-->
<!--        </DialogTrigger>-->
<!--        <DialogContent class="sm:max-w-[500px]">-->
<!--            <DialogHeader>-->
<!--                <DialogTitle>Property</DialogTitle>-->
<!--                <DialogDescription>-->
<!--                </DialogDescription>-->
<!--            </DialogHeader>-->

<!--            <form id="create-property" @submit="onSubmit" class="space-y-4">-->
<!--                <FieldGroup>-->
<!--                    <VeeField v-slot="{ field, errors }" name="code">-->
<!--                        <Field :data-invalid="!!errors.length">-->
<!--                            <FieldLabel :for="field.name">Code</FieldLabel>-->
<!--                            <Input-->
<!--                                :id="field.name"-->
<!--                                v-bind="field"-->
<!--                                placeholder="Enter the code"-->
<!--                                :aria-invalid="!!errors.length"-->
<!--                            />-->
<!--                            <FieldError :errors="getErrorMessages(errors)"/>-->
<!--                            <FieldDescription>Unique property ID</FieldDescription>-->
<!--                        </Field>-->
<!--                    </VeeField>-->

<!--                    <VeeField v-slot="{ field, errors }" name="locales">-->
<!--                        <Field :data-invalid="!!errors.length">-->
<!--                            <LocalizedGroup-->
<!--                                :id="field.name"-->
<!--                                :name="field.name"-->
<!--                                :model-value="field.value"-->
<!--                                @update:model-value="(v) => setFieldValue('locales', v)"-->
<!--                                :locales="['en', 'ru']"-->
<!--                                :fields="[-->
<!--                                    {-->
<!--                                        type: 'input',-->
<!--                                        name: 'name',-->
<!--                                        label: 'Name',-->
<!--                                        placeholder: 'Enter name'-->
<!--                                    },-->
<!--                                ]"-->
<!--                            />-->
<!--                            <FieldError :errors="getErrorMessages(errors)"/>-->
<!--                            <FieldDescription>This is public display property name.</FieldDescription>-->
<!--                        </Field>-->
<!--                    </VeeField>-->
<!--                </FieldGroup>-->
<!--            </form>-->

<!--            <DialogFooter>-->
<!--                <Field orientation="horizontal" class="justify-end">-->
<!--                    <Button-->
<!--                        type="submit"-->
<!--                        form="create-property"-->
<!--                        :disabled="ajax.state.loading"-->
<!--                    >-->
<!--                        {{ ajax.state.loading ? 'Processing..' : 'Create' }}-->
<!--                        <Spinner v-if="ajax.state.loading" />-->
<!--                    </Button>-->
<!--                </Field>-->
<!--            </DialogFooter>-->
<!--        </DialogContent>-->
<!--    </Dialog>-->
</template>
