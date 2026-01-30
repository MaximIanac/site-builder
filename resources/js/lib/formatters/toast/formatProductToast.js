import { h } from 'vue'
import {CheckCircle, DollarSign, Grid, Hash, Layers, Package, Tag, Image, Globe} from "lucide-vue-next";

export function formatProductToast(values) {
    return h('div', { class: 'space-y-3 text-foreground w-[320px]' }, [
        h('div', { class: 'flex items-start gap-3' }, [
            values.media?.[0] ? h('div', {
                class: 'relative w-12 h-12 rounded-lg overflow-hidden border border-border/50 flex-shrink-0'
            }, [
                h('img', {
                    src: URL.createObjectURL(values.media[0]),
                    class: 'w-full h-full object-cover',
                    alt: 'Product thumbnail'
                }),

                values.media.length > 1 && h('div', {
                    class: 'absolute -bottom-1 -right-1 px-1 py-0.5 text-[10px] font-medium rounded bg-secondary text-secondary-foreground border'
                }, `+${values.media.length - 1}`)
            ]) : h('div', {
                class: 'w-12 h-12 rounded-lg bg-secondary border border-border/50 flex items-center justify-center flex-shrink-0'
            }, h(Package, { class: 'size-5 text-muted-foreground' })),

            h('div', { class: 'space-y-1 flex-1 min-w-0' }, [
                h('div', { class: 'flex items-center justify-between' }, [
                    h('h3', { class: 'text-sm font-semibold text-foreground truncate' },
                        values.name?.en || 'New Product'
                    ),
                    values.category_id && h('span', {
                        class: 'text-xs px-1.5 py-0.5 rounded bg-primary/10 text-primary'
                    }, `Cat #${values.category_id}`)
                ]),
                h('code', {
                    class: 'text-xs text-muted-foreground font-mono block truncate'
                }, values.slug),
            ])
        ]),

        // СВОЙСТВА ПРОДУКТА
        values.properties?.length > 0 && h('div', { class: 'space-y-1' }, [
            h('div', { class: 'text-xs font-medium text-muted-foreground flex items-center gap-1' }, [
                h('div', { class: 'size-1.5 rounded-full bg-purple-500' }),
                h('span', 'Properties:')
            ]),
            h('div', { class: 'flex flex-wrap gap-1' }, [
                ...values.properties.slice(0, 3).map(prop =>
                    h('div', {
                        class: 'px-2 py-0.5 rounded-md bg-secondary/50 text-xs flex items-center gap-1 border border-border/30'
                    }, [
                        h('span', { class: 'font-medium text-foreground' }, prop.code),
                        h('span', { class: 'text-muted-foreground' }, '→'),
                        h('span', { class: 'text-foreground truncate max-w-[50px]' },
                            prop.value?.en || '—'
                        )
                    ])
                ),
                values.properties.length > 3 && h('span', {
                    class: 'text-xs text-muted-foreground px-1'
                }, `+${values.properties.length - 3}`)
            ])
        ]),

        // ВАРИАНТЫ (коротко)
        values.variants?.length > 0 && h('div', { class: 'space-y-1' }, [
            h('div', { class: 'text-xs font-medium text-muted-foreground flex items-center gap-1' }, [
                h('div', { class: 'size-1.5 rounded-full bg-green-500' }),
                h('span', `Variants (${values.variants.length}):`)
            ]),
            h('div', { class: 'space-y-1.5' }, [
                values.variants[0] && h('div', {
                    class: 'rounded-md bg-card border border-border/50 p-2'
                }, [
                    h('div', { class: 'flex items-center justify-between mb-1' }, [
                        h('span', { class: 'text-xs font-medium text-foreground' }, values.variants[0].sku),
                        h('div', { class: 'flex items-center gap-1 text-xs font-medium text-amber-600 dark:text-amber-400' }, [
                            h(DollarSign, { class: 'size-3' }),
                            h('span', values.variants[0].price.toFixed(2))
                        ])
                    ]),
                    h('div', { class: 'flex items-center justify-between text-xs text-muted-foreground' }, [
                        h('div', { class: 'flex items-center gap-1' }, [
                            h(Hash, { class: 'size-3' }),
                            h('span', `Stock: ${values.variants[0].stock}`)
                        ]),
                        // Свойства варианта (только коды)
                        values.variants[0].properties?.length > 0 && h('div', { class: 'flex items-center gap-1' }, [
                            h(Tag, { class: 'size-3' }),
                            h('span',
                                values.variants[0].properties.map(p => p.code).slice(0, 2).join(', ') +
                                (values.variants[0].properties.length > 2 ? '...' : '')
                            )
                        ])
                    ])
                ]),

                values.variants.length > 1 && h('div', {
                    class: 'text-xs text-muted-foreground px-1'
                }, [
                    h('span', 'Also: '),
                    ...values.variants.slice(1, 3).map((v, i) =>
                        h('span', { class: 'ml-1' }, [
                            h('span', { class: 'font-medium text-foreground' }, v.sku),
                            i < Math.min(values.variants.length - 2, 1) && ', '
                        ])
                    ),
                    values.variants.length > 3 && h('span', { class: 'ml-1' }, `+${values.variants.length - 3} more`)
                ])
            ])
        ]),
    ])
}
