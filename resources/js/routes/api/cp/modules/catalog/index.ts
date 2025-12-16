import categories from './categories'
import properties from './properties'
const catalog = {
    categories: Object.assign(categories, categories),
properties: Object.assign(properties, properties),
}

export default catalog