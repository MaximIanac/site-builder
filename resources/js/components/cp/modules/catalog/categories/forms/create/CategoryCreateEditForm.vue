<script setup>
import * as z from 'zod'
import {useForm} from "vee-validate";
import {toTypedSchema} from "@vee-validate/zod";
import {computed, onMounted, ref, watch} from "vue";
import CategoryBaseInformationFormCard
    from "@/components/cp/modules/catalog/categories/forms/create/form-cards/CategoryBaseInformationFormCard.vue";
import PropertiesGridFormCard
    from "@/components/cp/modules/catalog/categories/forms/create/form-cards/PropertiesGridFormCard.vue";
import PropertyGrid from "@/components/cp/modules/catalog/properties/list/PropertyGrid.vue";
import { Button } from "@/components/ui/button"
import {router} from "@inertiajs/vue3";
import { store, update } from "@/routes/cp/modules/catalog/categories/index.js";
import {Field} from "@/components/ui/field/index.js";
import {toast} from "vue-sonner";
import useAjax from "@/composables/useAjax.js";

const props = defineProps({
    category: Object,
    categories: Array,
    properties: Array,
})

const ajax = useAjax();
const propertiesData = ref(props.properties || [])

const createPeriodSchema = toTypedSchema(z.object({
    parent_id: z.number().nullable().optional(),
    locales: z.object({
        name: z.record(z.string(), z.string()),
        description: z.record(z.string(), z.string())
    }),
    inherited_properties: z.array(z.object({}).passthrough())
        .transform(arr => arr.map(item => item.id))
        .default([]),
    added_properties: z.array(z.object({}).passthrough())
        .transform(arr => arr.map(item => item.id))
        .default([]),
}))

const getInitialValues = () => {
    if (!props.category) {
        return {};
    }

    return {
        parent_id: props.category.parent?.id || null,
        locales: {
            name: props.category.translatable?.name,
            description: props.category.translatable?.description
        },
        inherited_properties: [],
        added_properties: [],
    };
}

const { handleSubmit, setFieldValue, values, setErrors } = useForm({
    validationSchema: createPeriodSchema,
    initialValues: getInitialValues(),
})

const onSubmit = handleSubmit(data => {
    if (props.category) {
        return router.put(update({category: props.category.slug}), data, {
            preserveState: true,
            onSuccess: (page) => {
                console.log(page)

                toast.success("Category has successfully updated")
            },
            onError: (err) => {
                setErrors(err);
                console.log(err)
            }
        })
    }

    router.post(store(), data, {
        preserveState: true,
        onSuccess: (page) => {
            console.log(page)

            toast.success("Category has created")
        },
        onError: (err) => {
            setErrors(err);
            console.log(err)
        }
    })
})

onMounted(async () => {
    if (props.category?.parent?.id) {
        await handleParentCategory(props.category?.parent?.id);
    }

    if (props.category?.properties) {
        setFieldValue('added_properties',
            props.category.properties.filter(all =>
                !values.inherited_properties.some(inherited => all.id === inherited.id)
            )
        )
    }
})

const handleToggledProperty = property => {
    const currentAddedProperties = [...values.added_properties]
    const index = currentAddedProperties.findIndex(
        added => added.id === property.id
    )

    if (index > -1) {
        currentAddedProperties.splice(index, 1)
    } else {
        currentAddedProperties.push(property)
    }

    setFieldValue('added_properties', currentAddedProperties)
}

const handleCreatedProperty = property => {
    propertiesData.value.push(property);

    const currentAddedProperties = [...values.added_properties]
    currentAddedProperties.push(property)

    setFieldValue('added_properties', currentAddedProperties)
}

const handleParentCategory = async (id) => {
    setFieldValue('parent_id', id);

    if (!id) {
        setFieldValue('inherited_properties', [])
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

    setFieldValue('inherited_properties', ajax.state.data.properties)
}

</script>

<template>
    <form id="create-edit-category" @submit="onSubmit">
        <div class="space-y-6">
            <Field orientation="horizontal" class="justify-end">
                <Button
                    type="submit"
                    form="create-edit-category"
                >
                    <span v-if="category">{{category.name}} edit</span>
                    <span v-else>Create</span>
                </Button>
            </Field>
            <div class="flex gap-8">
                <div class="flex-1 space-y-8">
                    <CategoryBaseInformationFormCard
                        :categories="categories"
                        :values="values"
                        @update:parent_id="handleParentCategory"
                        @update:locales="setFieldValue('locales', $event)"
                    />

                    <PropertiesGridFormCard
                        :added-properties="values.added_properties"
                        :inherited-properties="values.inherited_properties"
                        @created:property="handleCreatedProperty"
                    />
                </div>

                <PropertyGrid
                    :properties="propertiesData"
                    :added-properties="values.added_properties"
                    :inherited-properties="values.inherited_properties"
                    @toggle:property="handleToggledProperty"
                />
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>
