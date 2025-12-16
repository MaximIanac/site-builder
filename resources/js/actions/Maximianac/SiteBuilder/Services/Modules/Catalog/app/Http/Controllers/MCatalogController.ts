import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../../../../../wayfinder'
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogController.php:34
 * @route '/cp/modules/catalog'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/cp/modules/catalog',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogController.php:34
 * @route '/cp/modules/catalog'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogController.php:34
 * @route '/cp/modules/catalog'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogController.php:34
 * @route '/cp/modules/catalog'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogController.php:34
 * @route '/cp/modules/catalog'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogController.php:34
 * @route '/cp/modules/catalog'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\MCatalogController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/MCatalogController.php:34
 * @route '/cp/modules/catalog'
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
const MCatalogController = { index }

export default MCatalogController