<script setup>
import {Tabs, TabsList, TabsTrigger, TabsContent} from "@/components/ui/tabs";
import {computed, ref} from "vue";
import LocalizedElement from "@/components/sb/form-elements/localized/LocalizedElement.vue";

const props = defineProps({
    locales: {
        type: Array,
        default: () => ['en']
    },
    defaultLocale: {
        type: String,
        default: 'en'
    },
    fields: {
        type: Array,
        default: () => []
    },
    modelValue: {
        type: Object,
        default: () => ({})
    }
})

const emit = defineEmits(['update:modelValue'])

const activeLocale = ref(props.defaultLocale)

const formData = ref(props.modelValue)

const updateFieldValue = (locale, fieldName, value) => {
    const newData = { ...formData.value }

    if (!newData[fieldName]) newData[fieldName] = {}

    newData[fieldName][locale] = value
    formData.value = newData

    emit('update:modelValue', formData.value)
}

const getFieldValue = (locale, fieldName, field) => {
    if (field?.value) {
        return field.value(locale) || ''
    }

    return formData.value[fieldName]?.[locale] || ''
}
</script>

<template>
    <div>
        <Tabs :model-value="activeLocale" @update:model-value="activeLocale = $event">
            <TabsList class="flex">
                <TabsTrigger
                    v-for="locale in locales"
                    :key="locale"
                    :value="locale"
                    class="data-[state=active]:text-primary relative  w-full"
                >
                    {{ locale.toUpperCase() }}
                </TabsTrigger>
            </TabsList>

            <!-- Fields container -->
            <div class="mt-4">
                <div v-for="locale in locales" :key="locale">
                    <TabsContent :value="locale" class="space-y-4">
                        <!-- Slot for custom content -->
                        <slot :locale="locale" :update-field-value="updateFieldValue" :get-field-value="getFieldValue" />

                        <!-- Dynamic field groups -->
                        <div
                            v-for="(field, index) in fields"
                            :key="`${locale}-${field.name}-${index}`"
                            :class="field.wrapperClass"
                        >
                            <LocalizedElement
                                :field="field"
                                :locale="locale"
                                :model-value="getFieldValue(locale, field.name, field)"
                                @update:model-value="updateFieldValue(locale, field.name, $event)"
                            />
                        </div>
                    </TabsContent>
                </div>
            </div>
        </Tabs>
    </div>
</template>
