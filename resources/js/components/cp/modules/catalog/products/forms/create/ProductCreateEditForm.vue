<script setup>
import {Button} from "@/components/ui/button/index.js";
import {Field} from "@/components/ui/field/index.js";
import ProductBaseInfoFormCard from "@/components/cp/modules/catalog/products/forms/create/form-cards/ProductBaseInfoFormCard.vue";
import FileUploader from "@/components/sb/files/FileUploader.vue";
import ProductOffersFormCard
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

const props = defineProps({
    product: Object,
    categories: Array,
    offer_properties: Array,
})

const ajax = useAjax();

const createProductSchema = toTypedSchema(z.object({
    category_id: z.number().nullable().optional(),
    properties: z.array(z.object({}).passthrough()).default([]),
}))


const { handleSubmit, setFieldValue, values, setErrors } = useForm({
    validationSchema: createProductSchema,
})

const handleParentCategory = async (id) => {
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
</script>

<template>
    <form id="create-edit-product" @submit="">
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
                    <ProductBaseInfoFormCard
                        :categories="categories"
                        :properties="offer_properties"
                        :values="values"
                    />

                    <FileUploader />

                    <ProductOffersFormCard />
                </div>

                <div class="basis-md space-y-8">
                    <ProductCategoryFormCard
                        :categories="categories"
                        :values="[{ category_id: null}]"
                        @update:category_id="handleParentCategory"
                    />

                    <ProductPropertiesFormCard
                        :properties="values.properties"
                    />
                </div>
            </div>

        </div>
    </form>
</template>
