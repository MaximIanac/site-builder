<script setup>
import { Item, ItemContent } from '@/components/ui/item/index.js'
import Button from "../../../../../../ui/button/Button.vue";
import {GripVertical, Plus} from "lucide-vue-next";
import {useFieldArray} from "vee-validate";
import SliderItem from "@/components/cp/content/pages/blocks/cblock/sliderEntry/SliderItem.vue";
import { VueDraggableNext as draggable } from 'vue-draggable-next'
import {computed} from "vue";

const props = defineProps({
    slides: {
        type: Array,
        required: true,
    },
    name: {
        type: String,
        required: true,
    },
})

const { fields, move, remove, push } = useFieldArray(`${props.name}`)
const slidesRef = computed(() => props.slides)

/* const cloneEntries = (entries = []) => {
    return entries.map(item => ({
        ...item,
        key: `${item.key}`,
        value: {},
    }))
}

const createSlide = () => {
    const source =
        fields.value?.[0]?.value?.entries ??
        props.slides?.[0]?.entries ??
        []

    const entries = cloneEntries(source)

    push({ entries })
}*/

const createSlide = () => {
    push({
        entries:  []
    })
}

const removeSlide = (index) => {
    remove(index)
}

const handleListChange = (event) => {
    if (event.moved) {
        move(event.moved.oldIndex, event.moved.newIndex)
    }
}

</script>

<template>
    <Item class="dark:border-gray-700/80 p-3">
        <ItemContent class="gap-4" >
            <draggable
                v-if="!!slidesRef.length"
                v-model="fields"
                item-key="key"
                class="grid grid-cols-[repeat(auto-fill,minmax(250px,1fr))] gap-4"
                handle=".drag-handle"
                @change="handleListChange"
            >
                <div
                    class="flex"
                    v-for="(slide, index) in slides"
                    :key="index"
                >
                    <div>
                        <Button type="button" class="drag-handle border-r-0 !px-0.5 !flex h-full dark:bg-gray-900/25 dark:border-gray-700/50 dark:hover:bg-gray-800/50 rounded-r-none" variant="outline">
                            <GripVertical class="size-4" />
                        </Button>
                    </div>

                    <SliderItem
                        class="flex-grow"
                        :slide="slide"
                        :index="index"
                        :name="`${name}.${index}`"
                        @remove:slide="removeSlide"
                    />
                </div>
            </draggable>

            <Button @click="createSlide" type="button" variant="secondary" class="w-full h-full">
                <div class="flex gap-2 items-center justify-center">
                    <Plus />
                    <span class="text-muted-foreground text-xs">new slide</span>
                </div>
            </Button>
        </ItemContent>
    </Item>
</template>
