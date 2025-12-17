<script setup>
import {MoveVertical, Trash2, ArrowBigUp, ArrowBigDown} from "lucide-vue-next";
import {Button} from "@/components/ui/button";
import FormInput from "@/components/sb/form/elements/FormInput.vue";
import {Separator} from "@/components/ui/separator";
import {FieldGroup} from "@/components/ui/field/index.js";
import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card/index.js";
import {Label} from "@/components/ui/label/index.js";
import {Input} from "@/components/ui/input/index.js";
import {Badge} from "@/components/ui/badge/index.js";
import {ref} from "vue";
import VariantElementProperty from "@/components/cp/modules/catalog/products/blocks/variant/VariantElementProperty.vue";

const props = defineProps({
    variant: {
        type: Object,
        required: true,
    },
    index: {
        type: Number,
        required: true,
    },
    variantsCount: {
        type: Number,
        required: true,
    },
    variantProperties: {
        type: Array,
        default: () => []
    }
})
const emits = defineEmits(["move:up", "move:down", "remove"])

const propertiesData = ref(props.variantProperties)

</script>

<template>
    <Card>
        <CardHeader class="px-6 py-3">
            <div class="flex justify-between items-start">
                <CardTitle class="text-base">
                    Variant {{ index + 1 }}
                </CardTitle>

                <div class="flex items-center gap-2">
                    <Button
                        type="button"
                        variant="ghost"
                        size="sm"
                        :disabled="index === 0"
                        @click="emits('move:up', index)"
                        class="h-8 w-8 p-0"
                    >
                        <ArrowBigUp class="size-5" />
                    </Button>

                    <Button
                        type="button"
                        variant="ghost"
                        size="sm"
                        :disabled="index === variantsCount - 1"
                        @click="emits('move:down', index)"
                        class="h-8 w-8 p-0"
                    >
                        <ArrowBigDown class="size-5" />
                    </Button>

                    <Button
                        v-if="variantsCount > 1"
                        type="button"
                        variant="ghost"
                        size="sm"
                        @click="emits('remove', index)"
                        class="h-8 w-8 p-0 text-destructive hover:text-destructive hover:bg-destructive/10"
                    >
                        <Trash2 class="size-4" />
                    </Button>
                </div>
            </div>
        </CardHeader>
        <CardContent>
            <FieldGroup class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <FormInput
                    name="sku"
                    label="SKU"
                    placeholder="Enter the product unique SKU"
                />

                <FormInput
                    name="price"
                    label="Price (MDL)"
                    type="number"
                    placeholder="0.00"
                />

                <FormInput
                    name="storck"
                    label="Stock"
                    type="number"
                    placeholder="0"
                />
            </FieldGroup>

            <div v-if="propertiesData.length > 0">
                <Separator class="my-4" />

                <h4 class="font-medium text-sm mb-3">Properties</h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <VariantElementProperty
                        v-for="property in variant.properties"
                        :key="property.id"
                        :property="property"
                    />
                </div>
            </div>
        </CardContent>
    </Card>
</template>

<style scoped>

</style>
