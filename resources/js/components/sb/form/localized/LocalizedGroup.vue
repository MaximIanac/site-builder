<script setup>
import {Tabs, TabsList, TabsTrigger, TabsContent} from "@/components/ui/tabs/index.ts";
import {Field as VeeField, useField, useForm, useFormErrors} from "vee-validate";
import {computed, onMounted, reactive, ref, watch} from "vue";
import LocalizedElement from "@/components/sb/form/localized/LocalizedElement.vue";
import { Field, FieldError }  from "@/components/ui/field/index.ts";
import {getErrorMessages} from "@/lib/utils.js";
import useConfig from "@/composables/useConfig.js";
import Switch from "@/components/ui/switch/Switch.vue";
import Label from "@/components/ui/label/Label.vue";
import {ChevronDown, ChevronRight} from "lucide-vue-next";
import Button from "@/components/ui/button/Button.vue";

const props = defineProps({
    groupTitle: {
        type: String,
    },
    locales: {
        type: Array,
        default: () => useConfig().APP_LOCALES
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
    },
    scope: {
        type: String,
        default: 'locales'
    },

    label: {
        type: String,
    },
    is_active: {
        type: Boolean,
    }
})

const emit = defineEmits(['update:modelValue', 'update:isActive'])
const errors = useFormErrors();

const activeLocale = ref(props.defaultLocale)
const localeErrors = ref({})
const formData = ref(props.modelValue)
const isFilledLocale = ref({})
const isExpanded = ref(true)

const updateFieldValue = (locale, fieldName, value) => {
    const newData = JSON.parse(JSON.stringify(formData.value))

    if (!newData[fieldName]) newData[fieldName] = {}

    newData[fieldName][locale] = value
    formData.value = newData

    checkLocaleFilled();

    emit('update:modelValue', formData.value)
}

const getFieldValue = (locale, fieldName, field) => {
    if (field?.value) {
        return field.value(locale)
    }

    return formData.value[fieldName]?.[locale]
}

const checkLocaleErrors = (errorsObj) => {
    const result = {}

    props.fields.forEach(field => {
        const baseName = field.name

        props.locales.forEach(locale => {
            const key = `${baseName}.${locale}`

            if (errorsObj[key]) {
                result[locale] = true
            }
        })
    })

    localeErrors.value = result;
}

const checkLocaleFilled = () => {
    const count = props.fields.length;

    isFilledLocale.value = props.locales.reduce((acc, locale) => {
        const filledCount = props.fields.reduce((sum, fieldObj) => {
            return sum + (!!formData.value[fieldObj.name]?.[locale] ? 1 : 0);
        }, 0);

        acc[locale] = filledCount === count;

        return acc;
    }, {})
}

watch(errors, (n) => {
    checkLocaleErrors(n)
})

onMounted(() => {
    checkLocaleFilled();
})
</script>

<template>
    <Tabs :model-value="activeLocale" @update:model-value="activeLocale = $event" :unmountOnHide="false">
        <div class="flex justify-between rounded-t-lg bg-gray-50 dark:bg-neutral-800 px-1 pt-1">
            <div v-if="groupTitle" class="flex items-center gap-4">

<!--                <InlineEditLabel-->
<!--                    :name="`${name}.__${locale}`"-->
<!--                    :errorName="`${name}.key`"-->
<!--                    v-model="entry.key"-->
<!--                />-->

                <button
                    type="button"
                    @click="isExpanded = !isExpanded"
                    class="p-1 rounded-md hover:bg-gray-100 dark:hover:bg-neutral-800 transition-colors cursor-pointer"
                >
                    <ChevronRight
                        class="
                            h-4 w-4
                            text-gray-600 dark:text-neutral-400
                            transition-transform duration-200 ease-in-out
                        "
                        :class="{ 'rotate-90': isExpanded }"
                    />
                </button>

                <div v-if="label || is_active" class="flex items-center space-x-2 cursor-pointer">
                    <Switch
                        id="switch-option"
                        :model-value="is_active"
                        @update:model-value="$emit('update:isActive', $event)"
                        class="data-[state=checked]:bg-purple-700/50 data-[state=unchecked]:bg-gray-300 dark:data-[state=unchecked]:bg-neutral-600 [&_span]:bg-background/75"
                   />
                    <Label for="switch-option" class="text-xs text-muted-foreground cursor-pointer">
                        {{ label }}
                    </Label>
                </div>

                <h2 class="text-sm font-semibold text-foreground tracking-tight">
                    {{ groupTitle }}
                </h2>
            </div>
            <TabsList class="flex gap-1 !p-0 rounded-none !rounded-t-lg">
                <TabsTrigger
                    v-for="locale in locales"
                    :key="locale"
                    :value="locale"
                    class="
                        px-3 py-1 rounded-none cursor-pointer
                        border-b-3 rounded-lg data-[state=active]:border-transparent data-[state=active]:rounded-b-none
                        data-[state=active]:bg-gray-100 dark:data-[state=active]:bg-neutral-900 hover:bg-gray-200 dark:hover:bg-neutral-700"
                >
                    <span class="flex items-center gap-2">
                        <span
                            v-if="localeErrors?.[locale]"
                            class="w-2 h-2 rounded-full bg-red-500"
                        />

                        <span
                            v-else-if="!isFilledLocale?.[locale]"
                            class="w-2 h-2 rounded-full bg-yellow-400 dark:bg-yellow-600"
                        />
                        {{ locale.toUpperCase() }}
                    </span>
                </TabsTrigger>
            </TabsList>
        </div>

        <!-- Fields container -->
        <div class="relative">
            <div class="rounded-b-lg border-l-4 border-gray-50 dark:border-neutral-800 bg-gray-100 dark:bg-neutral-900 p-4">
                <div v-for="locale in locales" :key="locale">
                    <TabsContent
                        :value="locale"
                        class="space-y-4 transition-all duration-100"
                        :class="isExpanded
                            ? 'scale-y-100 opacity-100'
                            : 'h-0 scale-y-0 opacity-0 pointer-events-none'"
                    >
                        <slot :locale="locale" :update-field-value="updateFieldValue" :get-field-value="getFieldValue">
                            <div
                                v-for="(field, index) in fields"
                                :key="`${locale}-${field.name}-${index}`"
                                :class="field.wrapperClass"
                            >
                                <VeeField
                                    :name="`${field.name}.${locale}`"
                                    :model-value="getFieldValue(locale, field.name, field)"
                                    @update:model-value="updateFieldValue(locale, field.name, $event)"
                                    v-slot="{ field: f, errors }"
                                >
                                    <Field :data-invalid="!!errors.length">
                                        <LocalizedElement
                                            v-bind="f"
                                            :field="field"
                                            :is-errored="!!errors.length"
                                            :locale="locale"
                                            :model-value="getFieldValue(locale, field.name, field)"
                                            @update:model-value="updateFieldValue(locale, field.name, $event)"
                                        />

                                        <FieldError :errors="getErrorMessages(errors)" />
                                    </Field>
                                </VeeField>
                            </div>
                        </slot>
                    </TabsContent>
                </div>
            </div>
        </div>
    </Tabs>
</template>
