<script setup>
import {Card, CardContent, CardDescription, CardHeader, CardTitle} from "@/components/ui/card/index.ts";
import {ref} from "vue";
import {Badge} from "@/components/ui/badge/index.ts";
import {Button} from "@/components/ui/button/index.ts";
import PropertyCreateModalForm
    from "@/components/cp/modules/catalog/properties/forms/create/PropertyCreateModalForm.vue";
import {PropertyUsageType} from "@/enums/PropertyUsageType.js";

const props = defineProps({
    addedProperties: {
        type: Array,
        default: () => [],
    },
    inheritedProperties: {
        type: Array,
        default: () => [],
    },
})


const emits = defineEmits(['created:property'])

const handleCreatedProperty = (property) => {
    emits('created:property', property)
}
</script>

<template>
    <Card>
        <CardHeader>
            <CardTitle class="text-base">Category Properties Configuration</CardTitle>
            <CardDescription>Manage inherited and additional properties for this category</CardDescription>
        </CardHeader>

        <CardContent class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="font-mono text-xs uppercase text-text-secondary">
                        Inherited Properties
                        <span v-if="inheritedProperties.length > 0" class="ml-2 text-xs font-normal text-gray-500">
                            {{inheritedProperties.length}}
                        </span>
                    </span>
                    <span v-if="inheritedProperties.length === 0" class="text-xs italic text-gray-500">
                        No inherited properties
                    </span>
                </div>

                <Card>
                    <CardContent class="flex flex-wrap gap-2 min-h-[40px] border border-dashed border-gray-200 dark:border-gray-700 rounded-lg p-2">
                        <template v-for="property in inheritedProperties" :key="property.id">
                            <Badge class="max-w-[200px] group">
                                <span class="truncate flex items-center">
                                    <span v-if="property.is_required" class="text-red-400 mr-1">*</span>
                                    <span class="font-medium">{{property.name}}</span>
                                    <span class="mx-1 text-gray-400">-</span>
                                    <span class="lowercase font-mono text-gray-400 text-xs">{{property.code}}</span>
                                    <span class="ml-1 text-gray-400/70 text-[9px] font-mono">{{property.type}}</span>
                                </span>
                            </Badge>
                        </template>
                    </CardContent>
                </Card>
            </div>

            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="font-mono text-xs uppercase text-text-secondary">
                        Added Properties
                        <span v-if="addedProperties.length > 0" class="ml-2 text-xs font-normal text-gray-500">
                            {{addedProperties.length}}
                        </span>
                    </span>
                    <span v-if="addedProperties.length === 0" class="text-xs italic text-gray-500">
                        No added properties
                    </span>
                </div>

                <Card>
                    <CardContent class="flex flex-wrap gap-2 min-h-[40px] border border-dashed border-gray-200 dark:border-gray-700 rounded-lg p-2">
                        <template v-for="property in addedProperties" :key="property.id">
                            <Badge class="max-w-[200px] group">
                                <span class="truncate flex items-center">
                                    <span v-if="property.is_required" class="text-red-400 mr-1">*</span>
                                    <span class="font-medium">{{property.name}}</span>
                                    <span class="mx-1 text-gray-400">-</span>
                                    <span class="lowercase font-mono text-gray-400 text-xs">{{property.code}}</span>
                                    <span class="ml-1 text-gray-400/70 text-[9px] font-mono">{{property.type}}</span>
                                </span>
                            </Badge>
                        </template>
                    </CardContent>
                </Card>

                <PropertyCreateModalForm
                    :usage_type="PropertyUsageType.CATEGORY"
                    @created:property="handleCreatedProperty"
                />
            </div>
        </CardContent>
    </Card>
</template>

<style scoped>

</style>
