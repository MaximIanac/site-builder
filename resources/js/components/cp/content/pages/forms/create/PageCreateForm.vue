<script setup>
import useLocalizedSchema from "@/composables/validation/useLocalizedSchema.js";
import {toTypedSchema} from "@vee-validate/zod";
import * as z from "zod";
import {useForm} from "vee-validate";
import {router} from "@inertiajs/vue3";
import {store} from "@/routes/cp/modules/catalog/products/index.js";
import {toast} from "vue-sonner";
import {formatProductToast} from "@/lib/formatters/toast/formatProductToast.js";
import PageBaseInfoFormCard from "@/components/cp/content/pages/forms/create/form-card/PageBaseInfoFormCard.vue";
import PageCBlockFormCard from "@/components/cp/content/pages/forms/create/form-card/PageCBlockFormCard.vue";

const { localizeSchema, ensureObject } = useLocalizedSchema();

const createProductSchema = toTypedSchema(z.object({
    title: localizeSchema(true),
    slug: z.string(),
    is_active: z.boolean(),
    cblocks: z.array(z.object({
        id: z.number(),
        code: z.string(),
        value: localizeSchema()
    }).passthrough()).optional(),
}))

const { handleSubmit, setFieldValue, values, setErrors, errors } = useForm({
    validationSchema: createProductSchema,
})

const onSubmit = handleSubmit(data => {
    router.post(store(), data, {
        preserveState: true,
        onSuccess: (page) => {
            toast('Product created successfully!', {
                position: 'bottom-right',
                duration: Infinity,
                class: "flex flex-col gap-2",

                description: formatProductToast(data)
            })
        },
        onError: (err) => {
            setErrors(err);
            console.log(err)
        }
    })
})
</script>

<template>
    <div class="flex flex-wrap gap-8">
        <PageBaseInfoFormCard class="flex-[1_1_250px]" />

        <PageCBlockFormCard class="flex-[3_1_250px]" />
    </div>
</template>
