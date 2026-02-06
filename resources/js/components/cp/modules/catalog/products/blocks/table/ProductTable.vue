<script setup>
import {
    FlexRender,
    getCoreRowModel,
    getSortedRowModel,
    useVueTable,
} from '@tanstack/vue-table'
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import {productColumns} from "@/components/cp/modules/catalog/products/blocks/table/productColumns.js";
import {ref} from "vue";

const props = defineProps({
    columns: {
        type: Array,
        default: () => productColumns
    },
    data: {
        type: Array,
        required: true
    },
})

const dataTable = ref(props.data)

const table = useVueTable({
    data: dataTable,
    columns: props.columns,
    getCoreRowModel: getCoreRowModel(),
    getSortedRowModel: getSortedRowModel(),
    meta: {
        updateRow: (id, newData) => {
            dataTable.value = dataTable.value.map(row =>
                row.id === id
                    ? {
                        ...row,
                        ...Object.fromEntries(
                            Object.entries(newData).filter(([, v]) => v !== undefined)
                        )
                    } : row
            );
        },
    }
})
</script>

<template>
    <div class="rounded-md border">
        <Table>
            <TableHeader>
                <TableRow
                    v-for="headerGroup in table.getHeaderGroups()"
                    :key="headerGroup.id"
                >
                    <TableHead
                        v-for="header in headerGroup.headers"
                        :key="header.id"
                        :class="header.column.getCanSort() ? 'cursor-pointer select-none' : ''"
                        class="px-1"
                    >
                        <FlexRender
                            :render="header.column.columnDef.header"
                            :props="header.getContext()"
                        />
                    </TableHead>
                </TableRow>
            </TableHeader>

            <TableBody>
                <template v-if="table.getRowModel().rows?.length">
                    <TableRow
                        v-for="row in table.getRowModel().rows"
                        :key="row.id"
                        :data-state="row.getIsSelected() ? 'selected' : undefined"
                    >
                        <TableCell v-for="cell in row.getVisibleCells()" :key="cell.id" class="p-1">
                            <FlexRender
                                :render="cell.column.columnDef.cell"
                                :props="cell.getContext()"
                            />
                        </TableCell>
                    </TableRow>
                </template>

                <TableRow v-else>
                    <TableCell :colspan="columns.length" class="h-24 text-center">
                        No products found.
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
    </div>
</template>
