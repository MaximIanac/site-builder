import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../wayfinder'
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:30
 * @route '/cp/modules/catalog/products'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/cp/modules/catalog/products',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:30
 * @route '/cp/modules/catalog/products'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:30
 * @route '/cp/modules/catalog/products'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:30
 * @route '/cp/modules/catalog/products'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:30
 * @route '/cp/modules/catalog/products'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:30
 * @route '/cp/modules/catalog/products'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:30
 * @route '/cp/modules/catalog/products'
 */
        indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    index.form = indexForm
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::create
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:43
 * @route '/cp/modules/catalog/products/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/cp/modules/catalog/products/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::create
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:43
 * @route '/cp/modules/catalog/products/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::create
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:43
 * @route '/cp/modules/catalog/products/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::create
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:43
 * @route '/cp/modules/catalog/products/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::create
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:43
 * @route '/cp/modules/catalog/products/create'
 */
    const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: create.url(options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::create
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:43
 * @route '/cp/modules/catalog/products/create'
 */
        createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url(options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::create
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:43
 * @route '/cp/modules/catalog/products/create'
 */
        createForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    create.form = createForm
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:55
 * @route '/cp/modules/catalog/products'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/cp/modules/catalog/products',
} satisfies RouteDefinition<["post"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:55
 * @route '/cp/modules/catalog/products'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:55
 * @route '/cp/modules/catalog/products'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:55
 * @route '/cp/modules/catalog/products'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:55
 * @route '/cp/modules/catalog/products'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::show
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:121
 * @route '/cp/modules/catalog/products/{product}'
 */
export const show = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/cp/modules/catalog/products/{product}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::show
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:121
 * @route '/cp/modules/catalog/products/{product}'
 */
show.url = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { product: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'slug' in args) {
            args = { product: args.slug }
        }
    
    if (Array.isArray(args)) {
        args = {
                    product: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        product: typeof args.product === 'object'
                ? args.product.slug
                : args.product,
                }

    return show.definition.url
            .replace('{product}', parsedArgs.product.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::show
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:121
 * @route '/cp/modules/catalog/products/{product}'
 */
show.get = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::show
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:121
 * @route '/cp/modules/catalog/products/{product}'
 */
show.head = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::show
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:121
 * @route '/cp/modules/catalog/products/{product}'
 */
    const showForm = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::show
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:121
 * @route '/cp/modules/catalog/products/{product}'
 */
        showForm.get = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::show
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:121
 * @route '/cp/modules/catalog/products/{product}'
 */
        showForm.head = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    show.form = showForm
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::edit
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:132
 * @route '/cp/modules/catalog/products/{product}/edit'
 */
export const edit = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/cp/modules/catalog/products/{product}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::edit
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:132
 * @route '/cp/modules/catalog/products/{product}/edit'
 */
edit.url = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { product: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'slug' in args) {
            args = { product: args.slug }
        }
    
    if (Array.isArray(args)) {
        args = {
                    product: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        product: typeof args.product === 'object'
                ? args.product.slug
                : args.product,
                }

    return edit.definition.url
            .replace('{product}', parsedArgs.product.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::edit
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:132
 * @route '/cp/modules/catalog/products/{product}/edit'
 */
edit.get = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::edit
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:132
 * @route '/cp/modules/catalog/products/{product}/edit'
 */
edit.head = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::edit
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:132
 * @route '/cp/modules/catalog/products/{product}/edit'
 */
    const editForm = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: edit.url(args, options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::edit
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:132
 * @route '/cp/modules/catalog/products/{product}/edit'
 */
        editForm.get = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::edit
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:132
 * @route '/cp/modules/catalog/products/{product}/edit'
 */
        editForm.head = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    edit.form = editForm
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::update
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:145
 * @route '/cp/modules/catalog/products/{product}'
 */
export const update = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/cp/modules/catalog/products/{product}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::update
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:145
 * @route '/cp/modules/catalog/products/{product}'
 */
update.url = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { product: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'slug' in args) {
            args = { product: args.slug }
        }
    
    if (Array.isArray(args)) {
        args = {
                    product: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        product: typeof args.product === 'object'
                ? args.product.slug
                : args.product,
                }

    return update.definition.url
            .replace('{product}', parsedArgs.product.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::update
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:145
 * @route '/cp/modules/catalog/products/{product}'
 */
update.put = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::update
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:145
 * @route '/cp/modules/catalog/products/{product}'
 */
update.patch = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::update
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:145
 * @route '/cp/modules/catalog/products/{product}'
 */
    const updateForm = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::update
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:145
 * @route '/cp/modules/catalog/products/{product}'
 */
        updateForm.put = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::update
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:145
 * @route '/cp/modules/catalog/products/{product}'
 */
        updateForm.patch = (args: { product: string | { slug: string } } | [product: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PATCH',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    update.form = updateForm
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::destroy
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:249
 * @route '/cp/modules/catalog/products/{product}'
 */
export const destroy = (args: { product: string | number } | [product: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/cp/modules/catalog/products/{product}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::destroy
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:249
 * @route '/cp/modules/catalog/products/{product}'
 */
destroy.url = (args: { product: string | number } | [product: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { product: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    product: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        product: args.product,
                }

    return destroy.definition.url
            .replace('{product}', parsedArgs.product.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::destroy
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:249
 * @route '/cp/modules/catalog/products/{product}'
 */
destroy.delete = (args: { product: string | number } | [product: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::destroy
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:249
 * @route '/cp/modules/catalog/products/{product}'
 */
    const destroyForm = (args: { product: string | number } | [product: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogProductController::destroy
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogProductController.php:249
 * @route '/cp/modules/catalog/products/{product}'
 */
        destroyForm.delete = (args: { product: string | number } | [product: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
const products = {
    index: Object.assign(index, index),
create: Object.assign(create, create),
store: Object.assign(store, store),
show: Object.assign(show, show),
edit: Object.assign(edit, edit),
update: Object.assign(update, update),
destroy: Object.assign(destroy, destroy),
}

export default products