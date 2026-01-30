import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../../../../../../wayfinder'
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/api/cp/modules/catalog/properties'
 */
const indexc43a266d45ed66c836ed4a70e931f653 = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: indexc43a266d45ed66c836ed4a70e931f653.url(options),
    method: 'get',
})

indexc43a266d45ed66c836ed4a70e931f653.definition = {
    methods: ["get","head"],
    url: '/api/cp/modules/catalog/properties',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/api/cp/modules/catalog/properties'
 */
indexc43a266d45ed66c836ed4a70e931f653.url = (options?: RouteQueryOptions) => {
    return indexc43a266d45ed66c836ed4a70e931f653.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/api/cp/modules/catalog/properties'
 */
indexc43a266d45ed66c836ed4a70e931f653.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: indexc43a266d45ed66c836ed4a70e931f653.url(options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/api/cp/modules/catalog/properties'
 */
indexc43a266d45ed66c836ed4a70e931f653.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: indexc43a266d45ed66c836ed4a70e931f653.url(options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/api/cp/modules/catalog/properties'
 */
    const indexc43a266d45ed66c836ed4a70e931f653Form = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: indexc43a266d45ed66c836ed4a70e931f653.url(options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/api/cp/modules/catalog/properties'
 */
        indexc43a266d45ed66c836ed4a70e931f653Form.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: indexc43a266d45ed66c836ed4a70e931f653.url(options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/api/cp/modules/catalog/properties'
 */
        indexc43a266d45ed66c836ed4a70e931f653Form.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: indexc43a266d45ed66c836ed4a70e931f653.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    indexc43a266d45ed66c836ed4a70e931f653.form = indexc43a266d45ed66c836ed4a70e931f653Form
    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
const index43908caaffbc940ddbcc66d14957db13 = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index43908caaffbc940ddbcc66d14957db13.url(options),
    method: 'get',
})

index43908caaffbc940ddbcc66d14957db13.definition = {
    methods: ["get","head"],
    url: '/properties',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
index43908caaffbc940ddbcc66d14957db13.url = (options?: RouteQueryOptions) => {
    return index43908caaffbc940ddbcc66d14957db13.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
index43908caaffbc940ddbcc66d14957db13.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index43908caaffbc940ddbcc66d14957db13.url(options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
index43908caaffbc940ddbcc66d14957db13.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index43908caaffbc940ddbcc66d14957db13.url(options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
    const index43908caaffbc940ddbcc66d14957db13Form = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index43908caaffbc940ddbcc66d14957db13.url(options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
        index43908caaffbc940ddbcc66d14957db13Form.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index43908caaffbc940ddbcc66d14957db13.url(options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::index
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:22
 * @route '/properties'
 */
        index43908caaffbc940ddbcc66d14957db13Form.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index43908caaffbc940ddbcc66d14957db13.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    index43908caaffbc940ddbcc66d14957db13.form = index43908caaffbc940ddbcc66d14957db13Form

export const index = {
    '/api/cp/modules/catalog/properties': indexc43a266d45ed66c836ed4a70e931f653,
    '/properties': index43908caaffbc940ddbcc66d14957db13,
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:52
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
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:52
 * @route '/api/cp/modules/catalog/properties'
 */
storec43a266d45ed66c836ed4a70e931f653.url = (options?: RouteQueryOptions) => {
    return storec43a266d45ed66c836ed4a70e931f653.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:52
 * @route '/api/cp/modules/catalog/properties'
 */
storec43a266d45ed66c836ed4a70e931f653.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: storec43a266d45ed66c836ed4a70e931f653.url(options),
    method: 'post',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:52
 * @route '/api/cp/modules/catalog/properties'
 */
    const storec43a266d45ed66c836ed4a70e931f653Form = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: storec43a266d45ed66c836ed4a70e931f653.url(options),
        method: 'post',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:52
 * @route '/api/cp/modules/catalog/properties'
 */
        storec43a266d45ed66c836ed4a70e931f653Form.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: storec43a266d45ed66c836ed4a70e931f653.url(options),
            method: 'post',
        })
    
    storec43a266d45ed66c836ed4a70e931f653.form = storec43a266d45ed66c836ed4a70e931f653Form
    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:52
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
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:52
 * @route '/properties'
 */
store43908caaffbc940ddbcc66d14957db13.url = (options?: RouteQueryOptions) => {
    return store43908caaffbc940ddbcc66d14957db13.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:52
 * @route '/properties'
 */
store43908caaffbc940ddbcc66d14957db13.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store43908caaffbc940ddbcc66d14957db13.url(options),
    method: 'post',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:52
 * @route '/properties'
 */
    const store43908caaffbc940ddbcc66d14957db13Form = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store43908caaffbc940ddbcc66d14957db13.url(options),
        method: 'post',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogPropertyApiController::store
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogPropertyApiController.php:52
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

const MCatalogPropertyApiController = { index, store }

export default MCatalogPropertyApiController