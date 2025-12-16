import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../../../../../../wayfinder'
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/api/cp/modules/catalog/properties'
 */
const storec43a266d45ed66c836ed4a70e931f653 = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: storec43a266d45ed66c836ed4a70e931f653.url(options),
    method: 'post',
})

storec43a266d45ed66c836ed4a70e931f653.definition = {
    methods: ["post"],
    url: '/api/cp/modules/catalog/properties',
} satisfies RouteDefinition<["post"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/api/cp/modules/catalog/properties'
 */
storec43a266d45ed66c836ed4a70e931f653.url = (options?: RouteQueryOptions) => {
    return storec43a266d45ed66c836ed4a70e931f653.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/api/cp/modules/catalog/properties'
 */
storec43a266d45ed66c836ed4a70e931f653.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: storec43a266d45ed66c836ed4a70e931f653.url(options),
    method: 'post',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/api/cp/modules/catalog/properties'
 */
    const storec43a266d45ed66c836ed4a70e931f653Form = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: storec43a266d45ed66c836ed4a70e931f653.url(options),
        method: 'post',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/api/cp/modules/catalog/properties'
 */
        storec43a266d45ed66c836ed4a70e931f653Form.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: storec43a266d45ed66c836ed4a70e931f653.url(options),
            method: 'post',
        })
    
    storec43a266d45ed66c836ed4a70e931f653.form = storec43a266d45ed66c836ed4a70e931f653Form
    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
const store43908caaffbc940ddbcc66d14957db13 = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store43908caaffbc940ddbcc66d14957db13.url(options),
    method: 'post',
})

store43908caaffbc940ddbcc66d14957db13.definition = {
    methods: ["post"],
    url: '/properties',
} satisfies RouteDefinition<["post"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
store43908caaffbc940ddbcc66d14957db13.url = (options?: RouteQueryOptions) => {
    return store43908caaffbc940ddbcc66d14957db13.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
store43908caaffbc940ddbcc66d14957db13.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store43908caaffbc940ddbcc66d14957db13.url(options),
    method: 'post',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
    const store43908caaffbc940ddbcc66d14957db13Form = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store43908caaffbc940ddbcc66d14957db13.url(options),
        method: 'post',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
        store43908caaffbc940ddbcc66d14957db13Form.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store43908caaffbc940ddbcc66d14957db13.url(options),
            method: 'post',
        })
    
    store43908caaffbc940ddbcc66d14957db13.form = store43908caaffbc940ddbcc66d14957db13Form

export const store = {
    '/api/cp/modules/catalog/properties': storec43a266d45ed66c836ed4a70e931f653,
    '/properties': store43908caaffbc940ddbcc66d14957db13,
}

const MCatalogPropertyApiController = { store }

export default MCatalogPropertyApiController