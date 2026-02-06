<script setup>
import {Trash2, ArrowBigUp, ArrowBigDown} from "lucide-vue-next";
import {Button} from "@/components/ui/button";
import FormInput from "@/components/sb/form/shared/FormInput.vue";
import {Separator} from "@/components/ui/separator";
import {FieldGroup} from "@/components/ui/field/index.js";
import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card/index.js";
import {computed, ref, watch} from "vue";
import VariantElementProperty from "@/components/cp/modules/catalog/products/blocks/variant/VariantElementProperty.vue";
import LocalizedGroup from "@/components/sb/form/localized/LocalizedGroup.vue";
import useConfig from "@/composables/useConfig.js";
import {useField} from "vee-validate";

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
const emits = defineEmits(["remove"])

const propertiesData = computed(() => props.variantProperties)
const formNamePrefix = computed(() => `variants.${props.index}`)

const { value: sku } = useField(`${formNamePrefix.value}.sku`)
const { value: price } = useField(`${formNamePrefix.value}.price`)
const { value: quantity } = useField(`${formNamePrefix.value}.quantity`)
</script>

<template>
    <Card>
        <CardHeader class="px-6 py-3">
            <div class="flex justify-between items-start">
                <CardTitle class="text-base">
                    Variant {{ index + 1 }}
                </CardTitle>

<!--                <div class="flex items-center gap-2">-->
<!--                    <Button-->
<!--                        v-if="variantsCount > 1"-->
<!--                        type="button"-->
<!--                        variant="ghost"-->
<!--                        size="sm"-->
<!--                        @click="emits('remove', variant.id)"-->
<!--                        class="h-8 w-8 p-0 text-destructive hover:text-destructive hover:bg-destructive/10"-->
<!--                    >-->
<!--                        <Trash2 class="size-4" />-->
<!--                    </Button>-->
<!--                </div>-->
            </div>
        </CardHeader>
        <CardContent>
            <FieldGroup class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <FormInput
                    v-model="sku"
                    :name="`${formNamePrefix}.sku`"
                    :disabled="!variant.justCreated"
                    label="SKU"
                    placeholder="Enter the product unique SKU"
                />

                <FormInput
                    v-model="price"
                    :name="`${formNamePrefix}.price`"
                    label="Price (MDL)"
                    type="number"
                    placeholder="0.00"
                />

                <FormInput
                    v-model="quantity"
                    :name="`${formNamePrefix}.quantity`"
                    label="Quantity"
                    type="number"
                    placeholder="0"
                />
            </FieldGroup>

            <div v-if="propertiesData.length > 0">
                <Separator class="my-4" />

                <LocalizedGroup
                    :locales="useConfig().APP_LOCALES"
                >
                    <template v-slot="{ locale }">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <VariantElementProperty
                                v-for="(property, propIndex) in propertiesData"
                                :key="property.id"
                                :inputName="`${formNamePrefix}.properties.${propIndex}.`"
                                :property="property"
                                :locale="locale"
                            />
                        </div>
                    </template>
                </LocalizedGroup>
            </div>
        </CardContent>
    </Card>
</template>

<style scoped>

</style>
