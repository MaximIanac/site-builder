<script setup>
import useLocalizedSchema from "@/composables/validation/useLocalizedSchema.js";
import {toTypedSchema} from "@vee-validate/zod";
import * as z from "zod";
import {useForm} from "vee-validate";
import PageBaseInfoFormCard from "@/components/cp/content/pages/forms/create/form-card/PageBaseInfoFormCard.vue";
import PageCBlockFormCard from "@/components/cp/content/pages/forms/create/form-card/PageCBlockFormCard.vue";
import {computed, onMounted, onUnmounted, watch} from "vue";
import {Button} from "@/components/ui/button/index.js";
import {router} from "@inertiajs/vue3";
import {toast} from "vue-sonner";
import pages from "@/routes/cp/pages/index.js";
import {CBlockEntryType} from "@/enums/CBlockEntryType.js";
import FormTopButtonInfo from "@/components/sb/form/shared/FormTopButtonInfo.vue";
import {FormType} from "@/enums/FormType.js";

const props = defineProps({
    page: {
        type: Object,
    },
    formType: {
        type: String,
        required: true
    }
});

const { localizeSchema, ensureObject } = useLocalizedSchema();

const createPageSchema = toTypedSchema(z.object({
    id: z.number().optional(),
    title: localizeSchema(true),
    slug: z.string(),
    is_active: z.boolean().default(false),
    cblocks: z.array(z.object({
        id: z.union([z.number(), z.string()]).optional(),
        key: z.string(),
        is_active: z.boolean().default(false),
        entries: z.array(
            z.object({
                id: z.union([z.number(), z.string()]).optional(),
                key: z.string()
                    .min(1)
                    .max(50)
                    .regex(/^[A-Za-z][A-Za-z0-9_]*$/, {
                        message: "Only latin, numbers, and _, cannot start with a number, no spaces or special characters"
                    }),
                type: z.enum(Object.values(CBlockEntryType)),
                value:
                    z.union([
                        z.object({}).passthrough(),
                        z.instanceof(File)
                    ]).optional(),
                slides: z.array(
                    z.object({
                        id: z.union([z.number(), z.string()]).optional(),
                        entries: z.array(
                            z.object({
                                id: z.union([z.number(), z.string()]).optional(),
                                key: z.string()
                                    .min(1)
                                    .max(50)
                                    .regex(/^[A-Za-z][A-Za-z0-9_]*$/, {
                                        message: "Only latin, numbers, and _, cannot start with a number, no spaces or special characters"
                                    }),
                                type: z.enum(Object.values(CBlockEntryType).filter(i => i !== CBlockEntryType.SLIDER)),
                                value: localizeSchema(),
                            })
                        )
                    })
                ).nullable()
            })
        ).default([]),
    }).passthrough()).default([]),
}))

const getInitials = (state = []) => {
    const p = !!state.length || props.page
    if (!p) return {}

    return {
        id: p.id,
        title: ensureObject(p.translations.title),
        slug: p.slug,
        is_active: p.is_active,
        cblocks: (p.cblocks || []).map(cb => ({
            id: cb.id,
            key: cb.key,
            is_active: cb.is_active,
            entries: (cb.entries || []).map(e => ({
                id: e.id,
                key: e.key,
                type: e.type,
                value: e.type === CBlockEntryType.IMAGE
                    ? (e.image ?? {})
                    : ensureObject(e.translations?.value),
                slides: (e.slides || []).map(s => ({
                    id: s.id,
                    entries: (s.entries || []).map(se => ({
                        id: se.id,
                        key: se.key,
                        type: se.type,
                        value: se.type === CBlockEntryType.IMAGE
                            ? (se.image ?? {})
                            : ensureObject(se.translations?.value),
                    }))
                }))
            }))
        })),
    }
}

const { handleSubmit, setFieldValue, values, setErrors, errors, meta, resetForm } = useForm({
    validationSchema: createPageSchema,
    keepValuesOnUnmount: true,
    initialValues: getInitials(),
})

const isDirty = computed(() => meta.value.dirty)
const isFormValid = computed(() => meta.value.valid || Object.keys(errors.value).length === 0)

const onSubmit = handleSubmit(data => {
    if (props.formType === FormType.EDIT) {
        router.post(
            pages.update({page: props.page.slug}),
            {...data, _method: "put"},
            {
                onSuccess: (page) => {
                    toast.success('Page edited successfully!', {
                        duration: 10000,
                    })

                    resetForm({
                        values: getInitials(page.props.page)
                    })
                },
                onError: (err) => {
                    setErrors(err);
                    console.log(err)
                }
            }
        )

        return;
    }

    router.post(pages.store(), data, {
        preserveState: true,
        onSuccess: (page) => {
            console.log(page)
        },
        onError: (err) => {
            setErrors(err);
            console.log(err)
        }
    })
})

const handleReset = () => {
    resetForm()
    toast.info('Form has been reset')
}

let removeHook = null;

onMounted(() => {
    removeHook = router.on('before', (event) => {
        if (event.detail.visit.method !== 'get') return;

        if (isDirty.value) {
            if (!confirm('There are unsaved changes. Exit?')) {
                event.preventDefault()
            }
        }
    })
})

onUnmounted(() => {
    removeHook && removeHook()
})

watch(values, (v) => {
    // console.log(v.cblocks[0].entries)
})
watch(errors, (v) => {
    // console.log(v)
})
</script>

<template>
    <form id="create-edit-page" @submit="onSubmit">
        <div class="space-y-6">
            <FormTopButtonInfo
                :form-type="formType"
                :is-dirty="isDirty"
                :is-form-valid="isFormValid"
                @reset="handleReset"
            >
                <Button
                    type="submit"
                    form="create-edit-page"
                    :disabled="!isDirty || !isFormValid"
                >
                    <span>{{ props.formType === FormType.EDIT ? 'Edit Page' : 'Create' }}</span>
                </Button>
            </FormTopButtonInfo>

            <div class="flex flex-wrap gap-8">
                <PageBaseInfoFormCard class="flex-[1_1_250px]" />

                <PageCBlockFormCard
                    class="flex-[4_1_300px]"
                    :cblocks="values.cblocks"
                    @update:create-cblock="(v) => setFieldValue('cblocks', [ ...values.cblocks, v])"
                />
            </div>

        </div>
    </form>
</template>
