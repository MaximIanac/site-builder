import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition, applyUrlDefaults } from './../../../wayfinder'
/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::index
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:22
 * @route '/cp/pages'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/cp/pages',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::index
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:22
 * @route '/cp/pages'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::index
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:22
 * @route '/cp/pages'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::index
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:22
 * @route '/cp/pages'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::index
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:22
 * @route '/cp/pages'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::index
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:22
 * @route '/cp/pages'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::index
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:22
 * @route '/cp/pages'
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
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::create
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:34
 * @route '/cp/pages/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/cp/pages/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::create
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:34
 * @route '/cp/pages/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::create
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:34
 * @route '/cp/pages/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::create
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:34
 * @route '/cp/pages/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::create
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:34
 * @route '/cp/pages/create'
 */
    const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: create.url(options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::create
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:34
 * @route '/cp/pages/create'
 */
        createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url(options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::create
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:34
 * @route '/cp/pages/create'
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
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::store
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:43
 * @route '/cp/pages'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/cp/pages',
} satisfies RouteDefinition<["post"]>

/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::store
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:43
 * @route '/cp/pages'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::store
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:43
 * @route '/cp/pages'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::store
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:43
 * @route '/cp/pages'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::store
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:43
 * @route '/cp/pages'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::show
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:55
 * @route '/cp/pages/{page}'
 */
export const show = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})

show.definition = {
    methods: ["get","head"],
    url: '/cp/pages/{page}',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::show
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:55
 * @route '/cp/pages/{page}'
 */
show.url = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { page: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'slug' in args) {
            args = { page: args.slug }
        }
    
    if (Array.isArray(args)) {
        args = {
                    page: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        page: typeof args.page === 'object'
                ? args.page.slug
                : args.page,
                }

    return show.definition.url
            .replace('{page}', parsedArgs.page.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::show
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:55
 * @route '/cp/pages/{page}'
 */
show.get = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: show.url(args, options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::show
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:55
 * @route '/cp/pages/{page}'
 */
show.head = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: show.url(args, options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::show
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:55
 * @route '/cp/pages/{page}'
 */
    const showForm = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: show.url(args, options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::show
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:55
 * @route '/cp/pages/{page}'
 */
        showForm.get = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: show.url(args, options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::show
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:55
 * @route '/cp/pages/{page}'
 */
        showForm.head = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::edit
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:66
 * @route '/cp/pages/{page}/edit'
 */
export const edit = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})

edit.definition = {
    methods: ["get","head"],
    url: '/cp/pages/{page}/edit',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::edit
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:66
 * @route '/cp/pages/{page}/edit'
 */
edit.url = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { page: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'slug' in args) {
            args = { page: args.slug }
        }
    
    if (Array.isArray(args)) {
        args = {
                    page: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        page: typeof args.page === 'object'
                ? args.page.slug
                : args.page,
                }

    return edit.definition.url
            .replace('{page}', parsedArgs.page.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::edit
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:66
 * @route '/cp/pages/{page}/edit'
 */
edit.get = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: edit.url(args, options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::edit
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:66
 * @route '/cp/pages/{page}/edit'
 */
edit.head = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: edit.url(args, options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::edit
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:66
 * @route '/cp/pages/{page}/edit'
 */
    const editForm = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: edit.url(args, options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::edit
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:66
 * @route '/cp/pages/{page}/edit'
 */
        editForm.get = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: edit.url(args, options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::edit
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:66
 * @route '/cp/pages/{page}/edit'
 */
        editForm.head = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
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
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::update
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:77
 * @route '/cp/pages/{page}'
 */
export const update = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})

update.definition = {
    methods: ["put","patch"],
    url: '/cp/pages/{page}',
} satisfies RouteDefinition<["put","patch"]>

/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::update
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:77
 * @route '/cp/pages/{page}'
 */
update.url = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { page: args }
    }

            if (typeof args === 'object' && !Array.isArray(args) && 'slug' in args) {
            args = { page: args.slug }
        }
    
    if (Array.isArray(args)) {
        args = {
                    page: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        page: typeof args.page === 'object'
                ? args.page.slug
                : args.page,
                }

    return update.definition.url
            .replace('{page}', parsedArgs.page.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::update
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:77
 * @route '/cp/pages/{page}'
 */
update.put = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'put'> => ({
    url: update.url(args, options),
    method: 'put',
})
/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::update
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:77
 * @route '/cp/pages/{page}'
 */
update.patch = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteDefinition<'patch'> => ({
    url: update.url(args, options),
    method: 'patch',
})

    /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::update
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:77
 * @route '/cp/pages/{page}'
 */
    const updateForm = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: update.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'PUT',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::update
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:77
 * @route '/cp/pages/{page}'
 */
        updateForm.put = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: update.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'PUT',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
            /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::update
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:77
 * @route '/cp/pages/{page}'
 */
        updateForm.patch = (args: { page: string | { slug: string } } | [page: string | { slug: string } ] | string | { slug: string }, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
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
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::destroy
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:90
 * @route '/cp/pages/{page}'
 */
export const destroy = (args: { page: string | number } | [page: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

destroy.definition = {
    methods: ["delete"],
    url: '/cp/pages/{page}',
} satisfies RouteDefinition<["delete"]>

/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::destroy
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:90
 * @route '/cp/pages/{page}'
 */
destroy.url = (args: { page: string | number } | [page: string | number ] | string | number, options?: RouteQueryOptions) => {
    if (typeof args === 'string' || typeof args === 'number') {
        args = { page: args }
    }

    
    if (Array.isArray(args)) {
        args = {
                    page: args[0],
                }
    }

    args = applyUrlDefaults(args)

    const parsedArgs = {
                        page: args.page,
                }

    return destroy.definition.url
            .replace('{page}', parsedArgs.page.toString())
            .replace(/\/+$/, '') + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::destroy
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:90
 * @route '/cp/pages/{page}'
 */
destroy.delete = (args: { page: string | number } | [page: string | number ] | string | number, options?: RouteQueryOptions): RouteDefinition<'delete'> => ({
    url: destroy.url(args, options),
    method: 'delete',
})

    /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::destroy
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:90
 * @route '/cp/pages/{page}'
 */
    const destroyForm = (args: { page: string | number } | [page: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: destroy.url(args, {
                    [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                        _method: 'DELETE',
                        ...(options?.query ?? options?.mergeQuery ?? {}),
                    }
                }),
        method: 'post',
    })

            /**
* @see \Maximianac\SiteBuilder\Http\Controllers\Content\PageController::destroy
 * @see packages/maximianac/site-builder/src/Http/Controllers/Content/PageController.php:90
 * @route '/cp/pages/{page}'
 */
        destroyForm.delete = (args: { page: string | number } | [page: string | number ] | string | number, options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: destroy.url(args, {
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'DELETE',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'post',
        })
    
    destroy.form = destroyForm
const pages = {
    index: Object.assign(index, index),
create: Object.assign(create, create),
store: Object.assign(store, store),
show: Object.assign(show, show),
edit: Object.assign(edit, edit),
update: Object.assign(update, update),
destroy: Object.assign(destroy, destroy),
}

export default pages