<script setup>
import { toTypedSchema } from "@vee-validate/zod"
import { h } from "vue"
import * as z from "zod"
import { CirclePlus } from 'lucide-vue-next';
import { Button } from "@/components/ui/button"
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/components/ui/dialog"
import {
    Form,
    FormControl,
    FormDescription,
    FormField,
    FormItem,
    FormLabel,
    FormMessage,
} from "@/components/ui/form"
import { Input } from "@/components/ui/input"
import LocalizedGroup from "@/components/sb/form-elements/localized/LocalizedGroup.vue";
import {useForm} from "vee-validate";

const createPropertySchema = toTypedSchema(z.object({
    code: z.string(),
    locales: z.object({
        name: z.record(z.string(), z.string()),
    })
}))

const { handleSubmit, setFieldValue, values } = useForm({
    validationSchema: createPropertySchema
})

function onSubmit(values) {
}
</script>

<template>
    <Form v-slot="{ handleSubmit }" keep-values :validation-schema="createPropertySchema">
        <Dialog>
            <DialogTrigger as-child>
                <Button variant="outline" size="sm">
                    <CirclePlus />
                    Create new property
                </Button>
            </DialogTrigger>
            <DialogContent class="sm:max-w-[500px]">
                <DialogHeader>
                    <DialogTitle>Property</DialogTitle>
                    <DialogDescription>
                    </DialogDescription>
                </DialogHeader>

                <form id="create-property" @submit="handleSubmit($event, onSubmit)" class="space-y-4">
                    <FormField v-slot="{ componentField }" name="code">
                        <FormItem>
                            <FormLabel>Property code</FormLabel>
                            <FormControl>
                                <Input v-bind="componentField" />
                            </FormControl>
                            <FormDescription>
                                This is public display property name.
                            </FormDescription>
                            <FormMessage />
                        </FormItem>
                    </FormField>
                    <FormField name="locales">
                        <FormItem>
                            <FormLabel>Locales</FormLabel>
                            <FormControl>
                                <LocalizedGroup
                                    :model-value="values.locales"
                                    @update:model-value="(v) => setFieldValue('update:locales', v)"
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
                            </FormControl>
                            <FormDescription>
                                This is public display property name.
                            </FormDescription>
                            <FormMessage />
                        </FormItem>
                    </FormField>
                </form>

                <DialogFooter>
                    <Button type="submit" form="dialogForm">
                        Save changes
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </Form>
</template>
