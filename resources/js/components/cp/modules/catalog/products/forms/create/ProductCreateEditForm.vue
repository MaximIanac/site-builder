<script setup>
import {Button} from "@/components/ui/button/index.js";
import {Field} from "@/components/ui/field/index.js";
import ProductBaseInfoFormCard from "@/components/cp/modules/catalog/products/forms/create/form-cards/ProductBaseInfoFormCard.vue";
import FilePondFile from "@/components/sb/files/FilePondFile.vue";

const props = defineProps({
    product: Object,
    categories: Array,
    offer_properties: Array,
})
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
                <div class="flex-1 space-y-8">
                    <ProductBaseInfoFormCard
                        :categories="categories"
                        :properties="offer_properties"
                    />

                    <FilePondFile />

                </div>
            </div>

        </div>
    </form>
</template>
