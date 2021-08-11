import axios from '@/modules/axios';

let initState = () => ({
    categories: [],
    category: {},
    page: 1,
    errors: [],
    pagination: {}
})

let state = initState()

let mutations = {
    SET_CATEGORIES(state, categories) {
        state.categories = categories
    },
    SET_CATEGORY(state, category) {
        state.category = category;
    },
    SET_CATEGORIES_PAGE(state, page) {
        state.page = page;
    },
    SET_CATEGORY_PAGINATION(state, pagination) {
        state.pagination = pagination;
    },
    SET_CATEGORY_ERRORS(state, errors) {
        state.errors = errors;
    },
    SET_CATEGORY_STATE(state, newState) {
        Object.assign(state, newState)
    }
}

let actions = {
    async getCategories({ state, commit }) {
        let response = await axios.get(`/categories?page=${state.page}`)
        commit('SET_CATEGORIES', response.data.data)
        commit('SET_CATEGORY_PAGINATION', response.data.pagination)
    },

    async getCategory({ commit }, id) {
        try {
            let response = await axios.get(`/categories/${id}`);
            commit('SET_CATEGORY', response.data.data);
        } catch (error) {
            if (error.response.status === 404) {
                commit('SET_CATEGORY', null)
            }
        }
    },

    async getAllCategories({ commit }) {
        let response = await axios.get(`/categories?page=all`)
        commit('SET_CATEGORIES', response.data.data)
    },

    async updateCategory({ commit }, payload) {
        try {
            await axios.put(`/categories/${payload.id}`, payload.data)
            commit('SET_CATEGORY_ERRORS', [])
        } catch (error) {
            if (error.response.status === 422) {
                commit('SET_CATEGORY_ERRORS', error.response.data.errors)
            }
        }
    },
    async deleteCategory({ commit }, id) {
        await axios.delete(`/categories/${id}`);
        commit('SET_CATEGORY', {});
    },
    async createCategory({ commit }, payload) {
        try {
            let response = await axios.post('/categories', payload)
            commit('SET_CATEGORY', response.data.data);
            commit('SET_CATEGORY_ERRORS', [])
        } catch (error) {
            if (error.response.status === 422) {
                commit('SET_CATEGORY_ERRORS', error.response.data.errors)
            }
        }
    },
    resetCategoryState({ commit }) {
        commit('SET_CATEGORY_STATE', initState());
    }
}


export default {
    state,
    mutations,
    actions
}