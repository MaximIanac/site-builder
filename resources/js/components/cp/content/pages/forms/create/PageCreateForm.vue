<script setup>
import useLocalizedSchema from "@/composables/validation/useLocalizedSchema.js";
import {toTypedSchema} from "@vee-validate/zod";
import * as z from "zod";
import {useForm} from "vee-validate";
import PageBaseInfoFormCard from "@/components/cp/content/pages/forms/create/form-card/PageBaseInfoFormCard.vue";
import PageCBlockFormCard from "@/components/cp/content/pages/forms/create/form-card/PageCBlockFormCard.vue";
import {watch} from "vue";
import {Field} from "@/components/ui/field/index.js";
import {Button} from "@/components/ui/button/index.js";
import {router} from "@inertiajs/vue3";
import {toast} from "vue-sonner";
import {formatProductToast} from "@/lib/formatters/toast/formatProductToast.js";
import pages from "@/routes/cp/pages/index.js";
import {CBlockEntryType} from "@/enums/CBlockEntryType.js";

const { localizeSchema, ensureObject } = useLocalizedSchema();

const createPageSchema = toTypedSchema(z.object({
    id: z.number().optional(),
    title: localizeSchema(true),
    slug: z.string(),
    is_active: z.boolean().default(false),
    cblocks: z.array(z.object({
        id: z.number().optional(),
        key: z.string(),
        is_active: z.boolean().default(false),
        entries: z.array(
            z.object({
                id: z.union([z.number(), z.string()]).optional(),
                key: z.string()
                    .min(1)
                    .max(50)
                    .regex(/^[A-Za-z][A-Za-z0-9_]*$/, {
                        message: "Only latin, numbers, and _, cannot start with a number, no spaces or special characters"
                    }),
                type: z.enum(Object.values(CBlockEntryType)),
                value: localizeSchema(),
                slides: z.array(
                    z.object({
                        entries: z.array(
                            z.object({
                                id: z.union([z.number(), z.string()]).optional(),
                                key: z.string()
                                    .min(1)
                                    .max(50)
                                    .regex(/^[A-Za-z][A-Za-z0-9_]*$/, {
                                        message: "Only latin, numbers, and _, cannot start with a number, no spaces or special characters"
                                    }),
                                type: z.enum(Object.values(CBlockEntryType).filter(i => i !== CBlockEntryType.SLIDER)),
                                value: localizeSchema(),
                            })
                        )
                    })
                ).nullable()
            })
        ).default([]),
    }).passthrough()).default([]),
}))

const { handleSubmit, setFieldValue, values, setErrors, errors } = useForm({
    validationSchema: createPageSchema,
    keepValuesOnUnmount: true,
})
const onSubmit = handleSubmit(data => {
    console.log(data)

    // if (props.product) {
    //     console.log(data)
    //     router.post(update({product: props.product.slug}), {...data, _method: "put"}, {
    //         preserveState: true,
    //         onSuccess: (page) => {
    //             toast('Product edited successfully!', {
    //                 position: 'bottom-right',
    //                 duration: 10000,
    //                 class: "flex flex-col gap-2",
    //
    //                 description: formatProductToast(data)
    //             })
    //         },
    //         onError: (err) => {
    //             setErrors(err);
    //             console.log(err)
    //         }
    //     })
    //
    //     return;
    // }

    router.post(pages.store(), data, {
        preserveState: true,
        onSuccess: (page) => {
            console.log(page)
        },
        onError: (err) => {
            setErrors(err);
            console.log(err)
        }
    })
})

watch(values, (v) => {
    // console.log(v.cblocks[0].entries)
})
watch(errors, (v) => {
    console.log(v)
})
</script>

<template>
    <form id="create-edit-page" @submit="onSubmit">
        <div class="space-y-6">
            <Field orientation="horizontal" class="justify-end">
                <Button
                    type="submit"
                    form="create-edit-page"
                >
                    <span>Create</span>
                </Button>
            </Field>

            <div class="flex flex-wrap gap-8">
                <PageBaseInfoFormCard class="flex-[1_1_250px]" />

                <PageCBlockFormCard
                    class="flex-[4_1_300px]"
                    :cblocks="values.cblocks"
                    @update:create-cblock="(v) => setFieldValue('cblocks', [ ...values.cblocks, v])"
                />
            </div>

        </div>
    </form>
</template>
