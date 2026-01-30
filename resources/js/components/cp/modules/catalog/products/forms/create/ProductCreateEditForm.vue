<script setup>
import {Button} from "@/components/ui/button/index.js";
import {Field} from "@/components/ui/field/index.js";
import ProductBaseInfoFormCard from "@/components/cp/modules/catalog/products/forms/create/form-cards/ProductBaseInfoFormCard.vue";
import FileUploader from "@/components/sb/files/FileUploader.vue";
import ProductVariantsFormCard
    from "@/components/cp/modules/catalog/products/forms/create/form-cards/ProductVariantsFormCard.vue";
import ProductCategoryFormCard
    from "@/components/cp/modules/catalog/products/forms/create/form-cards/ProductCategoryFormCard.vue";
import {toast} from "vue-sonner";
import useAjax from "@/composables/useAjax.js";
import {toTypedSchema} from "@vee-validate/zod";
import * as z from "zod";
import {useForm} from "vee-validate";
import ProductPropertiesFormCard
    from "@/components/cp/modules/catalog/products/forms/create/form-cards/ProductPropertiesFormCard.vue";
import {useLocalizedSchema} from "@/composables/validation/useLocalizedSchema.js";
import {h, watch} from "vue";
import {router} from "@inertiajs/vue3";
import {formatProductToast} from "@/lib/formatters/toast/formatProductToast.js";
import {store} from "@/routes/cp/modules/catalog/products/index.js";

const props = defineProps({
    product: Object,
    categories: Array,
    offer_properties: Array,
})

const ajax = useAjax();

const createProductSchema = toTypedSchema(z.object({
    slug: z.string(),
    name: useLocalizedSchema(true),
    short_description: useLocalizedSchema(),
    description: useLocalizedSchema(),
    category: z.number().nullable().optional(),
    media: z.array(z.instanceof(File)).optional().default([]),
    properties: z.array(z.object({
        id: z.number(),
        code: z.string(),
        value: useLocalizedSchema()
    }).passthrough()).default([]),
    variants: z.array(z.object({
        sku: z.string().min(5),
        price: z.number(),
        stock: z.number(),
        properties: z.array(z.object({
            id: z.number(),
            code: z.string(),
            value: useLocalizedSchema()
        }).passthrough()).default([]),
    })).min(1),
}))

const { handleSubmit, setFieldValue, values, setErrors } = useForm({
    validationSchema: createProductSchema,
})

const onSubmit = handleSubmit(data => {
    // if (props.category) {
    //     return router.put(update({category: props.category.slug}), data, {
    //         preserveState: true,
    //         onSuccess: (page) => {
    //             console.log(page)
    //
    //             toast.success("Category has successfully updated")
    //         },
    //         onError: (err) => {
    //             setErrors(err);
    //             console.log(err)
    //         }
    //     })
    // }

    router.post(store(), data, {
        preserveState: true,
        onSuccess: (page) => {
            toast.info('Product Created Successfully!', {
                position: 'bottom-right',
                duration: 10000,
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
const handleCategory = async (id) => {
    setFieldValue('category_id', id);

    if (!id) {
        setFieldValue('properties', [])
        return;
    }

    await ajax.get(
        route('api.cp.modules.catalog.categories.parentProperties'),
        {category: id}
    )

    if (ajax.state.errors) {
        toast.error("Failed to fetch properties from parent category")
        return;
    }

    setFieldValue('properties', ajax.state.data.properties)
}

const handleVariantProperties = (newProps) => {
    setFieldValue("variants", values.variants.map(variant => {
        const currentProps = variant.properties || [];

        const mergedProps = Object.entries(newProps).map(([index, item]) => {
            const existing = currentProps.find(i => i.id === item.id);

            if (existing) {
                return { ...existing }
            }

            return { ...item }
        })


        return {
            ...variant,
            properties: mergedProps
        }
    }))
}

watch(values, () => {
    console.log(values)
})
</script>

<template>
    <form id="create-edit-product" @submit="onSubmit">
        <div class="space-y-6">
            <Field orientation="horizontal" class="justify-end">
                <Button
                    type="submit"
                    form="create-edit-product"
                >
                    <span>Create</span>
                </Button>
            </Field>

            <div class="flex gap-8">
                <div class="flex-grow space-y-8">
                    <ProductBaseInfoFormCard />

                    <FileUploader
                        :model-value="values.media"
                        @update:model-value="(files) => setFieldValue('media', files)"
                    />

                    <ProductVariantsFormCard
                        :variants="values.variants"
                        @update:variant-properties="handleVariantProperties"
                        :inherited-properties="values.properties"
                    />
                </div>

                <div class="basis-md space-y-8">
                    <ProductCategoryFormCard
                        :categories="categories"
                        :modelValue="values.category_id"
                        @update:modelValue="handleCategory"
                    />

                    <ProductPropertiesFormCard
                        :properties="values.properties"
                    />
                </div>
            </div>

        </div>
    </form>
</template>
