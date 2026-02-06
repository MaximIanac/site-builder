import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../../../../../../../wayfinder'
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:22
 * @route '/cp/modules/catalog/categories'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/cp/modules/catalog/categories',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:22
 * @route '/cp/modules/catalog/categories'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:22
 * @route '/cp/modules/catalog/categories'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:22
 * @route '/cp/modules/catalog/categories'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:22
 * @route '/cp/modules/catalog/categories'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:22
 * @route '/cp/modules/catalog/categories'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:22
 * @route '/cp/modules/catalog/categories'
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
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::create
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:37
 * @route '/cp/modules/catalog/categories/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/cp/modules/catalog/categories/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::create
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:37
 * @route '/cp/modules/catalog/categories/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::create
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:37
 * @route '/cp/modules/catalog/categories/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::create
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:37
 * @route '/cp/modules/catalog/categories/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::create
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:37
 * @route '/cp/modules/catalog/categories/create'
 */
    const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: create.url(options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::create
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:37
 * @route '/cp/modules/catalog/categories/create'
 */
        createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url(options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::create
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:37
 * @route '/cp/modules/catalog/categories/create'
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
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:61
 * @route '/cp/modules/catalog/categories'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/cp/modules/catalog/categories',
} satisfies RouteDefinition<["post"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:61
 * @route '/cp/modules/catalog/categories'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:61
 * @route '/cp/modules/catalog/categories'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:61
 * @route '/cp/modules/catalog/categories'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:61
 * @route '/cp/modules/catalog/categories'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::show
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:85
 * @route '/cp/modules/catalog/categories/{category}'
 */
export const show = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/cp/modules/catalog/categories/{category}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::show
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:85
 * @route '/cp/modules/catalog/categories/{category}'
 */
show.url = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { category: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'slug' in args) {
            args = { category: args.slug }
        }
    
    if (Array.isArray(args)) {
        args = {
                    category: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        category: typeof args.category === 'object'
                ? args.category.slug
                : args.category,
                }

    return show.definition.url
            .replace('{category}', parsedArgs.category.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::show
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:85
 * @route '/cp/modules/catalog/categories/{category}'
 */
show.get = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::show
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:85
 * @route '/cp/modules/catalog/categories/{category}'
 */
show.head = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::show
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:85
 * @route '/cp/modules/catalog/categories/{category}'
 */
    const showForm = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::show
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:85
 * @route '/cp/modules/catalog/categories/{category}'
 */
        showForm.get = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::show
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:85
 * @route '/cp/modules/catalog/categories/{category}'
 */
        showForm.head = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::edit
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:102
 * @route '/cp/modules/catalog/categories/{category}/edit'
 */
export const edit = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/cp/modules/catalog/categories/{category}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::edit
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:102
 * @route '/cp/modules/catalog/categories/{category}/edit'
 */
edit.url = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { category: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'slug' in args) {
            args = { category: args.slug }
        }
    
    if (Array.isArray(args)) {
        args = {
                    category: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        category: typeof args.category === 'object'
                ? args.category.slug
                : args.category,
                }

    return edit.definition.url
            .replace('{category}', parsedArgs.category.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::edit
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:102
 * @route '/cp/modules/catalog/categories/{category}/edit'
 */
edit.get = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::edit
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:102
 * @route '/cp/modules/catalog/categories/{category}/edit'
 */
edit.head = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::edit
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:102
 * @route '/cp/modules/catalog/categories/{category}/edit'
 */
    const editForm = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: edit.url(args, options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::edit
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:102
 * @route '/cp/modules/catalog/categories/{category}/edit'
 */
        editForm.get = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::edit
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:102
 * @route '/cp/modules/catalog/categories/{category}/edit'
 */
        editForm.head = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::update
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:120
 * @route '/cp/modules/catalog/categories/{category}'
 */
export const update = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/cp/modules/catalog/categories/{category}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::update
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:120
 * @route '/cp/modules/catalog/categories/{category}'
 */
update.url = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { category: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'slug' in args) {
            args = { category: args.slug }
        }
    
    if (Array.isArray(args)) {
        args = {
                    category: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        category: typeof args.category === 'object'
                ? args.category.slug
                : args.category,
                }

    return update.definition.url
            .replace('{category}', parsedArgs.category.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::update
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:120
 * @route '/cp/modules/catalog/categories/{category}'
 */
update.put = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::update
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:120
 * @route '/cp/modules/catalog/categories/{category}'
 */
update.patch = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::update
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:120
 * @route '/cp/modules/catalog/categories/{category}'
 */
    const updateForm = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::update
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:120
 * @route '/cp/modules/catalog/categories/{category}'
 */
        updateForm.put = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::update
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:120
 * @route '/cp/modules/catalog/categories/{category}'
 */
        updateForm.patch = (args: { category: string | { slug: string } } | [category: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::destroy
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:144
 * @route '/cp/modules/catalog/categories/{category}'
 */
export const destroy = (args: { category: string | number } | [category: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/cp/modules/catalog/categories/{category}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::destroy
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:144
 * @route '/cp/modules/catalog/categories/{category}'
 */
destroy.url = (args: { category: string | number } | [category: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { category: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    category: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        category: args.category,
                }

    return destroy.definition.url
            .replace('{category}', parsedArgs.category.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::destroy
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:144
 * @route '/cp/modules/catalog/categories/{category}'
 */
destroy.delete = (args: { category: string | number } | [category: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::destroy
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:144
 * @route '/cp/modules/catalog/categories/{category}'
 */
    const destroyForm = (args: { category: string | number } | [category: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogCategoryController::destroy
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogCategoryController.php:144
 * @route '/cp/modules/catalog/categories/{category}'
 */
        destroyForm.delete = (args: { category: string | number } | [category: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
const MCatalogCategoryController = { index, create, store, show, edit, update, destroy }

export default MCatalogCategoryController