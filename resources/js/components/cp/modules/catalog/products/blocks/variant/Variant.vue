<script setup>
import {Label} from "@/components/ui/label/index.js";
import {Input} from "@/components/ui/input/index.js";
import {MoveVertical, Plus, Trash2, X} from "lucide-vue-next";
import {Button} from "@/components/ui/button/index.js";
import {Badge} from "@/components/ui/badge/index.js";
import {FieldGroup} from "@/components/ui/field/index.js";
import FormInput from "@/components/sb/form/shared/FormInput.vue";
import {Separator} from "@/components/ui/separator/index.js";
import VariantElement from "@/components/cp/modules/catalog/products/blocks/variant/VariantElement.vue";


const moveOfferUp = (index) => {
    if (index > 0) {
        const temp = offers.value[index]
        offers.value[index] = offers.value[index - 1]
        offers.value[index - 1] = temp
    }
}

const moveOfferDown = (index) => {
    if (index < offers.value.length - 1) {
        const temp = offers.value[index]
        offers.value[index] = offers.value[index + 1]
        offers.value[index + 1] = temp
    }
}

const removeOffer = (index) => {
    offers.value.splice(index, 1)
}


</script>

<template>
    <div class="space-y-4">
        <h2 class="text-base font-semibold">Product Variants</h2>

        <div class="space-y-6">
            <!-- Properties Selection -->
            <div class="space-y-4">
                <div class="flex flex-wrap items-center gap-3">
                    <Button
                        type="button"
                        variant="default"
                        size="sm"
                        @click="showPropertiesModal = true"
                    >
                        <Plus class="mr-2 h-4 w-4" />
                        Add Properties
                    </Button>
                </div>
            </div>


            <!-- Offers List -->
            <VariantElement
                v-for="(variant, index) in variants"
                :variant="variant"
                :index="index"
                :variantsCount="variants.length"
            />
        </div>
    </div>
</template>

<style scoped>

</style>
