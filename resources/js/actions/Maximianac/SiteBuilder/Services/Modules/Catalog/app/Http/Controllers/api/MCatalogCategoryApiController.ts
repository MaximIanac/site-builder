import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../../../../../../../wayfinder'
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getCategoryParentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/api/cp/modules/catalog/categories/parentProperties'
 */
const getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73 = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73.url(options),
    method: 'get',
})

getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73.definition = {
    methods: ["get","head"],
    url: '/api/cp/modules/catalog/categories/parentProperties',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getCategoryParentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/api/cp/modules/catalog/categories/parentProperties'
 */
getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73.url = (options?: RouteQueryOptions) => {
    return getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getCategoryParentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/api/cp/modules/catalog/categories/parentProperties'
 */
getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73.url(options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getCategoryParentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/api/cp/modules/catalog/categories/parentProperties'
 */
getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73.url(options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getCategoryParentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/api/cp/modules/catalog/categories/parentProperties'
 */
    const getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73Form = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73.url(options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getCategoryParentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/api/cp/modules/catalog/categories/parentProperties'
 */
        getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73Form.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73.url(options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getCategoryParentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/api/cp/modules/catalog/categories/parentProperties'
 */
        getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73Form.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73.form = getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73Form
    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getCategoryParentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/categories/parentProperties'
 */
const getCategoryParentProperties22d1a0bbc08bac9913849f3328b50def = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getCategoryParentProperties22d1a0bbc08bac9913849f3328b50def.url(options),
    method: 'get',
})

getCategoryParentProperties22d1a0bbc08bac9913849f3328b50def.definition = {
    methods: ["get","head"],
    url: '/categories/parentProperties',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getCategoryParentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/categories/parentProperties'
 */
getCategoryParentProperties22d1a0bbc08bac9913849f3328b50def.url = (options?: RouteQueryOptions) => {
    return getCategoryParentProperties22d1a0bbc08bac9913849f3328b50def.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getCategoryParentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/categories/parentProperties'
 */
getCategoryParentProperties22d1a0bbc08bac9913849f3328b50def.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getCategoryParentProperties22d1a0bbc08bac9913849f3328b50def.url(options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getCategoryParentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/categories/parentProperties'
 */
getCategoryParentProperties22d1a0bbc08bac9913849f3328b50def.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getCategoryParentProperties22d1a0bbc08bac9913849f3328b50def.url(options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getCategoryParentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/categories/parentProperties'
 */
    const getCategoryParentProperties22d1a0bbc08bac9913849f3328b50defForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: getCategoryParentProperties22d1a0bbc08bac9913849f3328b50def.url(options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getCategoryParentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/categories/parentProperties'
 */
        getCategoryParentProperties22d1a0bbc08bac9913849f3328b50defForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getCategoryParentProperties22d1a0bbc08bac9913849f3328b50def.url(options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getCategoryParentProperties
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:15
 * @route '/categories/parentProperties'
 */
        getCategoryParentProperties22d1a0bbc08bac9913849f3328b50defForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getCategoryParentProperties22d1a0bbc08bac9913849f3328b50def.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    getCategoryParentProperties22d1a0bbc08bac9913849f3328b50def.form = getCategoryParentProperties22d1a0bbc08bac9913849f3328b50defForm

export const getCategoryParentProperties = {
    '/api/cp/modules/catalog/categories/parentProperties': getCategoryParentProperties91ee08145f84c3fccb6b73aaafe72f73,
    '/categories/parentProperties': getCategoryParentProperties22d1a0bbc08bac9913849f3328b50def,
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getAllChildCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/api/cp/modules/catalog/categories/childCategories'
 */
const getAllChildCategories54b65d9fcb0a4794b8d185e3899225eb = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getAllChildCategories54b65d9fcb0a4794b8d185e3899225eb.url(options),
    method: 'get',
})

getAllChildCategories54b65d9fcb0a4794b8d185e3899225eb.definition = {
    methods: ["get","head"],
    url: '/api/cp/modules/catalog/categories/childCategories',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getAllChildCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/api/cp/modules/catalog/categories/childCategories'
 */
getAllChildCategories54b65d9fcb0a4794b8d185e3899225eb.url = (options?: RouteQueryOptions) => {
    return getAllChildCategories54b65d9fcb0a4794b8d185e3899225eb.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getAllChildCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/api/cp/modules/catalog/categories/childCategories'
 */
getAllChildCategories54b65d9fcb0a4794b8d185e3899225eb.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getAllChildCategories54b65d9fcb0a4794b8d185e3899225eb.url(options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getAllChildCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/api/cp/modules/catalog/categories/childCategories'
 */
getAllChildCategories54b65d9fcb0a4794b8d185e3899225eb.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getAllChildCategories54b65d9fcb0a4794b8d185e3899225eb.url(options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getAllChildCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/api/cp/modules/catalog/categories/childCategories'
 */
    const getAllChildCategories54b65d9fcb0a4794b8d185e3899225ebForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: getAllChildCategories54b65d9fcb0a4794b8d185e3899225eb.url(options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getAllChildCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/api/cp/modules/catalog/categories/childCategories'
 */
        getAllChildCategories54b65d9fcb0a4794b8d185e3899225ebForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getAllChildCategories54b65d9fcb0a4794b8d185e3899225eb.url(options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getAllChildCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/api/cp/modules/catalog/categories/childCategories'
 */
        getAllChildCategories54b65d9fcb0a4794b8d185e3899225ebForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getAllChildCategories54b65d9fcb0a4794b8d185e3899225eb.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    getAllChildCategories54b65d9fcb0a4794b8d185e3899225eb.form = getAllChildCategories54b65d9fcb0a4794b8d185e3899225ebForm
    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getAllChildCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/categories/childCategories'
 */
const getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484 = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484.url(options),
    method: 'get',
})

getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484.definition = {
    methods: ["get","head"],
    url: '/categories/childCategories',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getAllChildCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/categories/childCategories'
 */
getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484.url = (options?: RouteQueryOptions) => {
    return getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484.definition.url + queryParams(options)
}

/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getAllChildCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/categories/childCategories'
 */
getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484.url(options),
    method: 'get',
})
/**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getAllChildCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/categories/childCategories'
 */
getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484.url(options),
    method: 'head',
})

    /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getAllChildCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/categories/childCategories'
 */
    const getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484Form = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484.url(options),
        method: 'get',
    })

            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getAllChildCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/categories/childCategories'
 */
        getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484Form.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484.url(options),
            method: 'get',
        })
            /**
* @see \Maximianac\SiteBuilder\Services\Modules\Catalog\app\Http\Controllers\api\MCatalogCategoryApiController::getAllChildCategories
 * @see packages/maximianac/site-builder/src/Services/Modules/Catalog/app/Http/Controllers/api/MCatalogCategoryApiController.php:28
 * @route '/categories/childCategories'
 */
        getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484Form.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484.form = getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484Form

export const getAllChildCategories = {
    '/api/cp/modules/catalog/categories/childCategories': getAllChildCategories54b65d9fcb0a4794b8d185e3899225eb,
    '/categories/childCategories': getAllChildCategoriesa7462f4c428ef8e772e91a482ebe6484,
}

const MCatalogCategoryApiController = { getCategoryParentProperties, getAllChildCategories }

export default MCatalogCategoryApiController