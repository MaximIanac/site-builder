<script setup>
import { Button } from "@/components/ui/button/index.ts"
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu/index.ts"
import {ChevronRight, ChevronLeft, SquarePen} from "lucide-vue-next";
import {computed, ref} from "vue";
import {Link} from "@inertiajs/vue3";
import {Checkbox} from "@/components/ui/checkbox/index.ts";
import {useCategorySelection} from "@/composables/modules/useCategorySelection.js";
import { edit } from "@/routes/cp/modules/catalog/categories/index.ts";
import CategoryItemTrigger from "@/components/cp/modules/catalog/categories/blocks/filters/CategoryItemTrigger.vue";

const props = defineProps({
    category: Object
})

const open = ref(false)
const children = ref(props.category.children)
const navigationStack = ref([])
const chosenCategoryToAction = ref(props.category)

const currentChildren = computed(() => {
    if (navigationStack.value.length === 0) {
        return children.value
    }
    const current = navigationStack.value[navigationStack.value.length - 1]
    return current.children || []
})

const currentParent = computed(() => {
    if (navigationStack.value.length === 0) return null
    if (navigationStack.value.length === 1) return props.category
    return navigationStack.value[navigationStack.value.length - 2]
})

const chosenCategory = computed(() => {
    if (navigationStack.value.length === 0) return props.category
    return navigationStack.value[navigationStack.value.length - 1]
})

const goForward = (child) => {
    chosenCategoryToAction.value = child;

    if (child.children && child.children.length > 0) {
        navigationStack.value.push(child)
    }
}

const goBack = () => {
    chosenCategoryToAction.value = currentParent.value;

    if (navigationStack.value.length > 0) {
        navigationStack.value.pop()
    }
}

const {
    toggleCategory,
    getCheckboxState,
} = useCategorySelection()

const handleCheckboxChange = (category, event) => {
    event.stopPropagation()
    toggleCategory(category)
}
</script>

<template>
    <DropdownMenu v-if="category.children.length" v-model:open="open">
        <DropdownMenuTrigger as-child>
            <CategoryItemTrigger
                :open="open"
                :category="category"
                :model-value="getCheckboxState(category)"
                @change="handleCheckboxChange(category, $event)"
            />
        </DropdownMenuTrigger>
        <DropdownMenuContent align="start" class="w-[300px]">
            <DropdownMenuLabel v-if="chosenCategory" class="flex justify-between items-center">
                {{ chosenCategory.name }}

                <Button
                    v-if="currentParent"
                    variant="ghost"
                    size="sm"
                    @click="goBack"
                    class="h-6 text-xs cursor-pointer"
                >
                    <ChevronLeft class="w-3 h-3 mr-1" />
                    to {{ currentParent.name }}
                </Button>
            </DropdownMenuLabel>

            <DropdownMenuSeparator />

            <DropdownMenuGroup>
                <DropdownMenuItem
                    v-for="child in currentChildren"
                    :key="child.id"
                    @select.prevent="goForward(child)"
                    class="flex items-center justify-between cursor-pointer"
                >
                    <div class="flex gap-2 items-center">
                        <div @click.stop class="flex items-center">
                            <Checkbox
                                class="cursor-pointer"
                                :model-value="getCheckboxState(child)"
                                @click="handleCheckboxChange(child, $event)"
                            />
                        </div>

                        <span>{{ child.name }}</span>
                    </div>

                    <div class="flex gap-2 items-center">
                        <Link
                            @click.stop
                            :href="edit(child.slug)"
                            :title="`Edit ${child.name}`"
                            class="text-blue-500 hover:text-blue-400 rounded-lg transition-all duration-200"
                        >
                            <SquarePen class="w-4 h-4" />
                        </Link>

                        <ChevronRight v-if="child.children && child.children.length > 0" class="w-4 h-4" />
                    </div>
                </DropdownMenuItem>

<!--                <DropdownMenuItem @select.prevent class="p-0 cursor-default focus:bg-transparent">-->
<!--                    <div class="flex flex-col items-center justify-between w-full py-2 gap-4">-->
<!--                        <div class="flex items-center gap-2">-->
<!--                            <Settings class="w-4 h-4 text-gray-500" />-->
<!--                            <span class="text-sm font-medium text-gray-400">-->
<!--                                Actions for:-->
<!--                            </span>-->
<!--                            <span class="text-sm text-gray-300 font-semibold truncate max-w-[120px]">-->
<!--                                {{ chosenCategoryToAction.name }}-->
<!--                            </span>-->
<!--                        </div>-->

<!--                        <div class="flex items-center justify-around gap-1 w-full">-->
<!--                            <Button as-child :variant="'outline'">-->
<!--                                <Link-->
<!--                                    :href="route('cp.modules.catalog.categories.edit', chosenCategoryToAction.slug)"-->
<!--                                    class="p-2 text-blue-500 hover:text-blue-400 rounded-lg transition-all duration-200"-->
<!--                                    :title="`Edit ${chosenCategoryToAction.name}`"-->
<!--                                >-->
<!--                                    <SquarePen class="w-4 h-4" /> Edit-->
<!--                                </Link>-->
<!--                            </Button>-->
<!--                            <Button-->
<!--                                :variant="'ghost'"-->
<!--                                class="cursor-pointer text-red-600 hover:text-red-500"-->
<!--                                :title="`Delete ${chosenCategoryToAction.name}`"-->
<!--                            >-->
<!--                                <Trash2 class="w-4 h-4" /> Delete-->
<!--                            </Button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </DropdownMenuItem>-->
            </DropdownMenuGroup>
        </DropdownMenuContent>
    </DropdownMenu>

    <CategoryItemTrigger
        v-else
        :open="open"
        :category="category"
        :model-value="getCheckboxState(category)"
        @change="handleCheckboxChange(category, $event)"
        :show-arrow="false"
    />

</template>

<style>
[data-indeterminate="true"] .checkbox-indicator {
    background-color: hsl(var(--primary));
    border-color: hsl(var(--primary));
}

[data-indeterminate="true"] .checkbox-indicator::after {
    content: "";
    display: block;
    width: 60%;
    height: 2px;
    background-color: white;
    margin: auto;
    border-radius: 1px;
}
</style>
