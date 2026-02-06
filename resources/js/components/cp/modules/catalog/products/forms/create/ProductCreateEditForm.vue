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
import useLocalizedSchema from "@/composables/validation/useLocalizedSchema.js";
import {h, watch} from "vue";
import {router} from "@inertiajs/vue3";
import {formatProductToast} from "@/lib/formatters/toast/formatProductToast.js";
import {store, update} from "@/routes/cp/modules/catalog/products/index.js";

const props = defineProps({
    product: Object,
    categories: Array,
    buttonLabel: {
        type: String,
        default: "Create"
    }
})

const ajax = useAjax();
const { localizeSchema, ensureObject } = useLocalizedSchema();

const createProductSchema = toTypedSchema(z.object({
    slug: z.string(),
    name: localizeSchema(true),
    short_description: localizeSchema(),
    description: localizeSchema(),
    category_id: z.number().nullable().optional(),
    media: z.array(
        z.union([z.object({}).passthrough(), z.instanceof(File)])
    ).optional(),
    properties: z.array(z.object({
        id: z.number(),
        code: z.string(),
        value: localizeSchema()
    }).passthrough()).default([]),
    variants: z.array(
        z.object({
            id: z.union([z.number(), z.string()]).nullable(),
            sku: z.string().min(5),
            price: z.coerce.number(),
            quantity: z.coerce.number(),
            properties: z.array(z.object({
                id: z.number(),
                code: z.string(),
                value: localizeSchema()
            }).passthrough()).default([]),
        })
    ).default([]),
}))

const getInitials = () => {
    const p = props.product
    if (!p) return { variants: []}

    console.log(props.product)

    return {
        slug: p.slug,
        name: ensureObject(p.translations.name),
        short_description: ensureObject(p.translations.short_description),
        description: ensureObject(p.translations.description),
        category_id: p.category?.id,
        media: p.images ?? [],
        properties: (p.properties ?? []).map(prop => ({
            id: prop.id,
            name: prop.name,
            code: prop.code,
            type: prop.type,
            value: ensureObject(prop.pivot?.translations),
        })),
        variants: p.variants ?? [],
    }
}

const { handleSubmit, setFieldValue, values, setErrors, errors } = useForm({
    validationSchema: createProductSchema,
    initialValues: getInitials()
})

const onSubmit = handleSubmit(data => {
    if (props.product) {
        console.log(data)
        router.post(update({product: props.product.slug}), {...data, _method: "put"}, {
            preserveState: true,
            onSuccess: (page) => {
                toast('Product edited successfully!', {
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

        return;
    }

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

const handleCategory = async (id) => {
    setFieldValue('category_id', Number(id));

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

watch(errors, (v) => {
    // console.log(v)
})
watch(values, (v) => {
    // console.log(v)
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
                    <span>{{ buttonLabel }}</span>
                </Button>
            </Field>

            <div class="flex gap-8">
                <div class="flex-grow space-y-8">
                    <ProductBaseInfoFormCard />

                    <FileUploader
                        :errors="Object.entries(errors)
                            .filter(([key]) => key.includes('media'))
                            .map(([_, value]) => value)"
                        :model-value="values.media"
                        @update:model-value="(files) => setFieldValue('media', files)"
                    />

                    <ProductVariantsFormCard
                        :variants="values.variants"
                        @update:variants="(v) => setFieldValue('variants', v)"
                        @update:add-variant="(v) => setFieldValue('variants', [ ...values.variants, v])"
                        @update:remove-variant="(id) => setFieldValue('variants', values.variants.filter(i => i.id !== id))"

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
                        @update:properties="(v) => setFieldValue('properties', v)"
                    />
                </div>
            </div>
        </div>
    </form>
</template>
