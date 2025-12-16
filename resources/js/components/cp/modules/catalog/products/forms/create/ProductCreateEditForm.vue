<script setup>
import {Button} from "@/components/ui/button/index.js";
import {Field} from "@/components/ui/field/index.js";

</script>

<template>
    <form id="create-edit-product" @submit="">
        <div class="space-y-6">
            <Field orientation="horizontal" class="justify-end">
                <Button
                    type="submit"
                    form="create-edit-product"
                >
                    <span>Create</span>
                </Button>
            </Field>
        </div>
    </form>
</template>
