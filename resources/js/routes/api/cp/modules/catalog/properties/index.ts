import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../../wayfinder'
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:19
 * @route '/api/cp/modules/catalog/properties'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/api/cp/modules/catalog/properties',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:19
 * @route '/api/cp/modules/catalog/properties'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:19
 * @route '/api/cp/modules/catalog/properties'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:19
 * @route '/api/cp/modules/catalog/properties'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:19
 * @route '/api/cp/modules/catalog/properties'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:19
 * @route '/api/cp/modules/catalog/properties'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:19
 * @route '/api/cp/modules/catalog/properties'
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
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:49
 * @route '/api/cp/modules/catalog/properties'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/api/cp/modules/catalog/properties',
} satisfies RouteDefinition<["post"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:49
 * @route '/api/cp/modules/catalog/properties'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:49
 * @route '/api/cp/modules/catalog/properties'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:49
 * @route '/api/cp/modules/catalog/properties'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:49
 * @route '/api/cp/modules/catalog/properties'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
const properties = {
    index: Object.assign(index, index),
store: Object.assign(store, store),
}

export default properties