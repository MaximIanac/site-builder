<script setup>
import {Label} from "@/components/ui/label/index.js";
import {Input} from "@/components/ui/input/index.js";
import {Button} from "@/components/ui/button/index.js";
import {Badge} from "@/components/ui/badge/index.js";
import {X} from "lucide-vue-next";
import {Card, CardContent} from "@/components/ui/card/index.js";

const props = defineProps({
    property: {
        type: Object,
        required: true,
    }
})
const emits = defineEmits(['toggle:property'])

</script>

<template>
    <Card>
        <CardContent class="px-4 py-2 space-y-2">
            <Label class="flex items-center gap-2">
                <span>{{ property.name }}</span>
                <Badge variant="outline" class="text-xs font-mono lowercase">
                    {{ property.code }}
                </Badge>
                <Badge
                    v-if="property.is_required"
                    variant="destructive"
                    class="text-xs"
                >
                    Required
                </Badge>
            </Label>

            <Input
                v-if="property.type === 'string'"
                v-model="property.value"
                type="text"
                :placeholder="`Enter ${property.name.toLowerCase()}`"
            />

            <div class="flex justify-between items-center">
                <Badge variant="outline" class="text-xs capitalize">
                    {{ property.type }}
                </Badge>

                <Button
                    type="button"
                    variant="ghost"
                    size="sm"
                    @click="emits('toggle:property', property)"
                    class="h-7 text-xs text-muted-foreground hover:text-destructive"
                >
                    <X class="mr-1 h-3 w-3" />
                    Remove
                </Button>
            </div>
        </CardContent>
    </Card>
</template>
