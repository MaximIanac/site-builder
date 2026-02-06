import { h } from 'vue'
import {
    ArrowUpDown,
    Eye,
    Edit,
    Trash2,
    MoreHorizontal,
    Package,
    DollarSign,
    Image as ImageIcon,
    Check,
    X,
    Tag,
    FileText,
    Hash,
    Globe,
    Layers,
    BarChart3, ShoppingBag, ExternalLink, ChevronRight
} from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Badge } from '@/components/ui/badge'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import VariantCell from "@/components/cp/modules/catalog/products/blocks/table/cells/VariantCell.vue";
import {Link, router} from "@inertiajs/vue3";
import categories from "@/routes/cp/modules/catalog/categories/index.js";
import products from "@/routes/cp/modules/catalog/products/index.js";

export const productColumns = [
    {
        accessorKey: 'thumbnail',
        header: '',
        cell: ({ row }) => {
            const product = row.original
            if (product.thumbnail) {
                return h(Avatar, { class: 'h-12 w-12 border rounded-md' }, () => [
                    h(AvatarImage, {
                        src: product.thumbnail.original_url,
                        alt: product.thumbnail.alt || product.name
                    }),
                    h(AvatarFallback, () => [
                        h(ImageIcon, { class: 'h-6 w-6 text-muted-foreground' })
                    ])
                ])
            }
            return h(Avatar, { class: 'h-12 w-12 border bg-muted rounded-md' }, () => [
                h(AvatarFallback, () => [
                    h(ImageIcon, { class: 'h-6 w-6 text-muted-foreground' })
                ])
            ])
        },
    },
    {
        accessorKey: 'name',
        header: ({ column }) => {
            return h(Button, {
                variant: 'ghost',
                class: 'px-0 hover:bg-transparent font-medium',
                onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
            }, () => [
                'Name',
                h(ArrowUpDown, { class: 'h-4 w-4 ml-2' })
            ])
        },
        cell: ({ row }) => {
            const product = row.original
            return h('div', { class: 'flex flex-col space-y-1' }, [
                h('div', { class: 'font-medium truncate max-w-[200px]' }, product.name),
                h('div', { class: 'text-xs text-muted-foreground truncate max-w-[200px]' }, [
                    h(Globe, { class: 'h-3 w-3 inline mr-1' }),
                    ' ',
                    product.slug
                ])
            ])
        },
    },
    {
        accessorKey: 'category',
        header: ({ column }) => {
            return h(Button, {
                variant: 'ghost',
                class: 'px-0 hover:bg-transparent font-medium',
                onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
            }, () => [
                'Category',
                h(ArrowUpDown, { class: 'h-4 w-4 ml-2' })
            ])
        },
        cell: ({ row }) => {
            const category = row.original.category
            if (!category) {
                return h(Badge, { variant: 'outline', class: 'text-muted-foreground' }, () => '-')
            }

            return h(Link, {
                href: categories.edit({category: category.slug}),
                class: 'hover:underline decoration-dashed underline-offset-2'
            }, () =>
                h(Badge, {
                    variant: 'secondary',
                    class: 'hover:bg-secondary/80 transition-colors cursor-pointer'
                }, () => category.name)
            )
        },
    },
    {
        accessorKey: 'variants',
        header: ({ column }) => {
            return h(Button, {
                variant: 'ghost',
                class: 'px-0 hover:bg-transparent font-medium',
                onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
            }, () => [
                h(Package, { class: 'h-4 w-4 mr-2' }),
                'Variants',
                h(ArrowUpDown, { class: 'h-4 w-4 ml-2' })
            ])
        },
        cell: ({ row }) => {
            const product = row.original

            return h('div', { class: 'py-1' },
                h(VariantCell, {
                    variants: product.variants || [],
                    productId: product.id,
                    productName: product.name,
                })
            )
        },
    },
    {
        accessorKey: 'short_description',
        header: ({ column }) => {
            return h(Button, {
                variant: 'ghost',
                class: 'font-medium',
                onClick: () => column.toggleSorting(column.getIsSorted() === 'asc'),
            }, () => [
                h(FileText, { class: 'h-4 w-4' }),
                'Description'
            ])
        },
        cell: ({ row }) => {
            const description = row.original.short_description
            if (!description) {
                return h('span', { class: 'text-muted-foreground text-sm italic' }, '-')
            }
            return h('div', {
                class: 'max-w-[250px] truncate text-sm text-muted-foreground',
                title: description
            }, description)
        },
    },
    {
        id: 'quick_actions',
        cell: ({ row }) => {
            const product = row.original

            return h('div', { class: 'flex flex-col gap-1.5' }, [
                h(Link, {
                    href: products.edit({product: product.slug}),
                    class: 'group flex items-center gap-2 text-sm hover:text-primary transition-colors'
                }, () => [
                    h(Edit, { class: 'h-3.5 w-3.5' }),
                    h('span', { class: 'group-hover:underline underline-offset-2' }, 'Edit')
                ]),

                h(Link, {
                    href: products.edit({product: product.slug}),
                    target: '_blank',
                    class: 'group flex items-center gap-2 text-sm hover:text-primary transition-colors'
                }, () =>[
                    h(ExternalLink, { class: 'h-3.5 w-3.5' }),
                    h('span', { class: 'group-hover:underline underline-offset-2' }, 'View')
                ])
            ])
        },
    }
]
