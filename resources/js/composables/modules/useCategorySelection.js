import { ref, computed } from 'vue'

export const useCategorySelection = () => {
    const checkedCategories = ref(new Set())

    const getAllDescendants = (category) => {
        const descendants = []
        const collectDescendants = (cat) => {
            if (cat.children && cat.children.length > 0) {
                cat.children.forEach(child => {
                    descendants.push(child.id)
                    collectDescendants(child)
                })
            }
        }
        collectDescendants(category)
        return descendants
    }

    const toggleCategory = (category) => {
        const categoryId = category.id
        const allDescendants = getAllDescendants(category)
        const newSet = new Set(checkedCategories.value)

        if (newSet.has(categoryId)) {
            newSet.delete(categoryId)
            allDescendants.forEach(descendantId => newSet.delete(descendantId))
        } else {
            newSet.add(categoryId)
            allDescendants.forEach(descendantId => newSet.add(descendantId))
        }

        checkedCategories.value = newSet
    }

    const getCheckboxState = (category) => {
        if (!category.children || category.children.length === 0) {
            return checkedCategories.value.has(category.id)
        }

        const allRelatedIds= getAllDescendants(category)
        const totalCount = allRelatedIds.length
        const checkedCount = allRelatedIds.filter(id => checkedCategories.value.has(id)).length


        if (checkedCount === 0) {
            checkedCategories.value.delete(category.id)
            return false
        }

        if (checkedCount === totalCount) {
            checkedCategories.value.add(category.id)
            return true
        }

        return 'indeterminate'
    }

    const isCategoryChecked = (id) => {
        return checkedCategories.value.has(id)
    }

    return {
        checkedCategories: computed(() => checkedCategories.value),
        toggleCategory,
        getCheckboxState,
        isCategoryChecked
    }
}
