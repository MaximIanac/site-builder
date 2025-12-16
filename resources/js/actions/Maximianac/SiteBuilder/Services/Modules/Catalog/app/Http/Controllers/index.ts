import MCatalogController from './MCatalogController'
import MCatalogCategoryController from './MCatalogCategoryController'
import MCatalogProductController from './MCatalogProductController'
import api from './api'
const Controllers = {
    MCatalogController: Object.assign(MCatalogController, MCatalogController),
MCatalogCategoryController: Object.assign(MCatalogCategoryController, MCatalogCategoryController),
MCatalogProductController: Object.assign(MCatalogProductController, MCatalogProductController),
api: Object.assign(api, api),
}

export default Controllers