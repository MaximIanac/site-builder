import MCatalogCategoryApiController from './MCatalogCategoryApiController'
import MCatalogPropertyApiController from './MCatalogPropertyApiController'
const api = {
    MCatalogCategoryApiController: Object.assign(MCatalogCategoryApiController, MCatalogCategoryApiController),
MCatalogPropertyApiController: Object.assign(MCatalogPropertyApiController, MCatalogPropertyApiController),
}

export default api