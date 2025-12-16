import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/properties',
} satisfies RouteDefinition<["post"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
const properties = {
    store: Object.assign(store, store),
}

export default properties