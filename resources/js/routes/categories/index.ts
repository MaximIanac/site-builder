import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../wayfinder'
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::parentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/categories/parentProperties'
 */
export const parentProperties = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: parentProperties.url(options),
    method: 'get',
})

parentProperties.definition = {
    methods: ["get","head"],
    url: '/categories/parentProperties',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::parentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/categories/parentProperties'
 */
parentProperties.url = (options?: RouteQueryOptions) => {
    return parentProperties.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::parentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/categories/parentProperties'
 */
parentProperties.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: parentProperties.url(options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::parentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/categories/parentProperties'
 */
parentProperties.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: parentProperties.url(options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::parentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/categories/parentProperties'
 */
    const parentPropertiesForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: parentProperties.url(options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::parentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/categories/parentProperties'
 */
        parentPropertiesForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: parentProperties.url(options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::parentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/categories/parentProperties'
 */
        parentPropertiesForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: parentProperties.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    parentProperties.form = parentPropertiesForm
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::childCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/categories/childCategories'
 */
export const childCategories = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: childCategories.url(options),
    method: 'get',
})

childCategories.definition = {
    methods: ["get","head"],
    url: '/categories/childCategories',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::childCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/categories/childCategories'
 */
childCategories.url = (options?: RouteQueryOptions) => {
    return childCategories.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::childCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/categories/childCategories'
 */
childCategories.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: childCategories.url(options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::childCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/categories/childCategories'
 */
childCategories.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: childCategories.url(options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::childCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/categories/childCategories'
 */
    const childCategoriesForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: childCategories.url(options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::childCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/categories/childCategories'
 */
        childCategoriesForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: childCategories.url(options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::childCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/categories/childCategories'
 */
        childCategoriesForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: childCategories.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    childCategories.form = childCategoriesForm
const categories = {
    parentProperties: Object.assign(parentProperties, parentProperties),
childCategories: Object.assign(childCategories, childCategories),
}

export default categories