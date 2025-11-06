<script setup>
import {Card} from "@/components/ui/card/index.ts";
import {Button} from "@/components/ui/button/index.js";
import {CardContent, CardHeader, CardTitle} from "@/components/ui/card/index.ts";
import {FormControl, FormField, FormItem, FormLabel, FormMessage} from "@/components/ui/form/index.ts";
import ListPopover from "@/components/sb/popover/ListPopover.vue";
import * as z from 'zod'
import {useForm} from "vee-validate";
import {toTypedSchema} from "@vee-validate/zod";
import { X } from 'lucide-vue-next';
import LocalizedGroup from "@/components/sb/form-elements/localized/LocalizedGroup.vue";
import {watch} from "vue";
import BaseInformationFormCard
    from "@/components/cp/modules/catalog/categories/forms/create/form-cards/BaseInformationFormCard.vue";
import PropertiesGridFormCard
    from "@/components/cp/modules/catalog/categories/forms/create/form-cards/PropertiesGridFormCard.vue";

const props = defineProps({
    categories: Array,
    properties: Array,
})

const createPeriodSchema = toTypedSchema(z.object({
    parent_category_id: z.number().nullable().optional(),
    locales: z.object({
        title: z.record(z.string(), z.string()),
        description: z.record(z.string(), z.string())
    })
}))

const { handleSubmit, setFieldValue, values } = useForm({
    validationSchema: createPeriodSchema
})

watch(values, () => {
    // console.log(values)
})

</script>

<template>
    <form action="">
        <div class="space-y-6">
            <div class="flex gap-8">
                <div class="flex-1 space-y-8">
                    <BaseInformationFormCard
                        :categories="categories"
                        :values="values"
                        @update:parent_category_id="setFieldValue('parent_category_id', $event)"
                        @update:locales="setFieldValue('locales', $event)"
                    />

                    <PropertiesGridFormCard

                    />
                </div>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
