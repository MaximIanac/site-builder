<script setup>
import { computed } from 'vue'
import {Popover, PopoverTrigger, PopoverContent} from "@/components/ui/popover/index.js";
import {Separator} from "@/components/ui/separator";
import {Package,DollarSign,Check,X,Tag,Hash,ChevronRight} from 'lucide-vue-next'
import {Badge} from "@/components/ui/badge/index.js";

const props = defineProps({
    variants: {
        type: Array,
        default: () => []
    },
    productId: {
        type: [Number, String],
        required: true
    },
    productName: {
        type: String,
        default: ''
    },
})

const firstVariant = computed(() => props.variants[0] || {})
const totalQuantity = computed(() =>
    props.variants.reduce((sum, v) => sum + (v.quantity || 0), 0)
)
const inStockCount = computed(() =>
    props.variants.filter(v => v.quantity > 0).length
)
</script>

<template>
    <Popover v-if="variants.length > 0">
        <PopoverTrigger as-child>
            <div class="flex flex-col gap-1 cursor-pointer hover:bg-muted/50 p-2 rounded-lg transition-colors group">
                <div class="flex items-start gap-3">
                    <div class="flex gap-1 items-center">
                        <span class="text-xs font-medium mt-1">{{ variants.length }}</span>
                        <Package class="h-5 w-5 text-blue-600" />
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span
                                    class="text-xs font-mono bg-muted px-1.5 py-0.5 rounded truncate max-w-[120px]"
                                    :title="firstVariant.sku"
                                >
                                    {{ firstVariant.sku }}
                                </span>

                                <Badge
                                    variant="outline"
                                    class="text-xs h-5"
                                >
                                    <Check v-if="firstVariant.quantity > 0" class="h-3 w-3 mr-1" />
                                    <X v-else class="h-3 w-3 mr-1" />
                                    {{ firstVariant.quantity }} pcs.
                                </Badge>


                                <div
                                    v-if="variants.length > 1"
                                    class="text-xs text-blue-600 flex items-center gap-1"
                                >
                                    +{{ variants.length - 1 }} <Package class="h-4 w-4 text-blue-600" />
                                    <ChevronRight class="h-3 w-3" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-1">
                    <span class="text-xs text-muted-foreground">MDL</span>
                    <span class="font-medium">{{ firstVariant.price.toFixed(2) }}</span>
                </div>
            </div>
        </PopoverTrigger>

        <PopoverContent class="w-[450px] p-0" align="start">
            <div class="sticky top-0 z-10 bg-background border-b px-4 py-3">
                <div>
                    <h3 class="font-semibold">Variants</h3>
                    <p class="text-sm text-muted-foreground truncate">
                        {{ productName }}
                    </p>
                </div>

                <!-- Статистика -->
                <div class="flex items-center gap-2 mt-2 text-sm">
                    <div class="flex items-center gap-1">
                        <Package class="h-4 w-4" />
                        <span class="font-medium">{{ variants.length }}</span>
                    </div>

                    <Separator orientation="vertical" class="h-4" />

                    <div class="flex items-center gap-1">
                        <Check class="h-4 w-4 text-green-600" />
                        <span class="font-medium">{{ inStockCount }}</span>
                        <span class="text-muted-foreground">in stock</span>
                    </div>

                    <Separator orientation="vertical" class="h-4" />

                    <div class="flex items-center gap-1">
                        <span class="font-medium">{{ totalQuantity }}</span>
                        <span class="text-muted-foreground">pcs. total</span>
                    </div>
                </div>
            </div>

            <div class="max-h-[400px] overflow-y-auto">
                <div
                    v-for="variant in variants"
                    :key="variant.id"
                    class="p-3 hover:bg-muted/50 border-b last:border-b-0"
                >
                    <div class="flex items-start justify-between">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-2">
                                <Hash class="h-3 w-3 text-muted-foreground flex-shrink-0" />
                                <span
                                    class="font-mono text-sm truncate"
                                    :title="variant.sku"
                                >
                                    {{ variant.sku }}
                                </span>

                                <Badge
                                    :variant="variant.quantity > 0 ? 'default' : 'destructive'"
                                    class="text-xs h-5"
                                >
                                    {{ variant.quantity }} pcs.
                                </Badge>
                            </div>

                            <div
                                v-if="variant.properties && variant.properties.length > 0"
                                class="flex flex-wrap gap-1"
                            >
                                <Badge
                                    v-for="prop in variant.properties.slice(0, 2)"
                                    :key="prop.id"
                                    variant="outline"
                                    class="text-xs h-6"
                                >
                                    <Tag class="h-3 w-3 mr-0.5" />
                                    <span class="truncate max-w-[100px]">{{ prop.name }}: {{ prop.pivot.value }}</span>
                                </Badge>

                                <Badge
                                    v-if="variant.properties.length > 3"
                                    variant="secondary"
                                    class="text-xs h-6"
                                >
                                    +{{ variant.properties.length - 2 }}
                                </Badge>
                            </div>
                        </div>

                        <div class="text-right ml-4">
                            <div class="flex items-center gap-1">
                                <span class="text-sm text-muted-foreground">MDL</span>
                                <span class="font-bold">{{ variant.price.toFixed(2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </PopoverContent>
    </Popover>
</template>
