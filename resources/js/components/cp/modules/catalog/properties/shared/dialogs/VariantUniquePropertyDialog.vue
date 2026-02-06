<script setup>
import { Card, CardContent } from '@/components/ui/card/index.js'
import { Input } from '@/components/ui/input/index.js'
import { Separator } from '@/components/ui/separator/index.js'
import { Dialog, DialogContent, DialogHeader, DialogTitle } from '@/components/ui/dialog/index.js'
import { Search, X } from 'lucide-vue-next'
import PropertyCreateForm from "@/components/cp/modules/catalog/properties/forms/create/PropertyCreateForm.vue";
import {PropertyUsageType} from "@/enums/PropertyUsageType.js";
import {CardHeader} from "@/components/ui/card/index.ts";
import VariantPropertyBadge
    from "@/components/cp/modules/catalog/properties/shared/badges/VariantPropertyBadge.vue";
import useAjax from "@/composables/useAjax.js";
import {computed, onMounted, onUnmounted, reactive, ref, watch} from "vue";
import {toast} from "vue-sonner";
import { debounce } from 'lodash-es';
import CheckboxPropertyBadge from "@/components/cp/modules/catalog/properties/shared/badges/CheckboxPropertyBadge.vue";
import {InputGroup, InputGroupAddon, InputGroupInput, InputGroupText} from "@/components/ui/input-group/index.js";
import {Spinner} from "@/components/ui/spinner/index.js";

const emit = defineEmits(['update:unique-properties'])
const props = defineProps({
    inheritedProperties: {
        type: Array,
        default: () => [],
    },
    uniqueProperties: {
        type: Array,
        default: () => [],
    }
})

const ajax = useAjax();
const payload = reactive({
    search: '',
    exclude_ids: props.inheritedProperties.map(p => p.id)
});
const filteredProperties = ref([])
const pickedProperties = ref(props.uniqueProperties)

const fetchProperties = async () => {
    await ajax.get(
        route('api.cp.modules.catalog.properties.index'), payload
    )

    if (ajax.state.errors) {
        toast.error("Fetching properties error")
    }

    filteredProperties.value = ajax.state.data;
}
const fetchPropertiesDebounced = debounce(fetchProperties, 200);

const toggleProperty = (property) => {
    if (!pickedProperties.value.some(p => p.id === property.id)) {
        pickedProperties.value.push(property)
    } else {
        pickedProperties.value = pickedProperties.value.filter(p => p.id !== property.id)
    }

    emit('update:unique-properties', pickedProperties.value);
}

const isPickedProperty = (property) => {
    return pickedProperties.value.some(p => p.id === property.id)
}

watch(
    () => ({
        search: payload.search,
        excludeIds: props.inheritedProperties.map(p => p.id)
    }),
    ({ search, excludeIds }) => {
        payload.search = search;
        payload.exclude_ids = excludeIds;
        fetchPropertiesDebounced();
    },
    { deep: true }
);

watch(() => props.uniqueProperties, (newUnique) => {
    pickedProperties.value = newUnique
});

onMounted(() => {
    fetchProperties();
});

onUnmounted(() => {
    fetchPropertiesDebounced.cancel();
});
</script>

<template>
    <Dialog>
        <DialogContent class="min-w-3/4 md:min-w-3/5 max-w-4xl">
            <DialogHeader>
                <DialogTitle>Add unique properties to product variants</DialogTitle>
            </DialogHeader>

            <Separator />

            <!-- Selected Properties -->
            <div v-if="pickedProperties.length > 0" class="space-y-3">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <div class="h-2 w-2 rounded-full bg-primary"></div>
                        <h3 class="text-sm font-medium">
                            Picked Properties
                            <span class="text-muted-foreground font-normal">
                                ({{ pickedProperties.length }})
                            </span>
                        </h3>
                    </div>
                </div>

                <div class="flex flex-wrap gap-2">
                    <VariantPropertyBadge
                        v-for="property in pickedProperties"
                        :key="property.id"
                        :property="property"
                        :is-picked="isPickedProperty(property)"
                        @click="toggleProperty(property)"
                    />
                </div>
            </div>

            <!-- Properties Selection -->
            <div class="flex flex-wrap gap-6">
                <!-- Properties List -->
                <div class="flex-grow space-y-4">
                    <div class="relative">
                        <InputGroup>
                            <InputGroupAddon>
                                <Search />
                            </InputGroupAddon>
                            <InputGroupInput
                                v-model="payload.search"
                                placeholder="Search properties..."
                            />
                            <InputGroupAddon align="inline-end">
                                <Spinner
                                     class="animate-spin"
                                     :class="[ajax.state.loading ? 'opacity-100' : 'opacity-0']"
                                />
                            </InputGroupAddon>
                        </InputGroup>
                    </div>

                    <div class="overflow-hidden">
                        <div class="max-h-96 overflow-y-auto">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                <CheckboxPropertyBadge
                                    v-for="property in filteredProperties"
                                    :key="property.id"
                                    :property="property"
                                    :checked="isPickedProperty(property)"
                                    @toggle="toggleProperty"
                                />
                            </div>

                            <div
                                v-if="filteredProperties.length === 0"
                                class="p-3 text-center text-muted-foreground"
                            >
                                No properties found
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Create New Property -->
                <div class="flex-grow basis-[300px]">
                    <Card>
                        <CardHeader>
                            <h4 class="font-medium">Create New Property</h4>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <PropertyCreateForm :usage_type="PropertyUsageType.PRODUCT" />
                        </CardContent>
                    </Card>
                </div>
            </div>
        </DialogContent>
    </Dialog>
</template>
