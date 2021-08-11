import axios from "@/modules/axios";

let initState = ()  => ({
    products: [],
    product: {},
    page: 1,
    pagination:{},
    errors:[]
});

let state = initState()

let mutations = {
    SET_PRODUCTS(state, products) {
        state.products = products
    },
    SET_PRODUCT(state, product) {
        state.product = product
    },
    SET_PAGE(state, page) {
        state.page = page
    },
    SET_PRODUCT_ERRORS(state, errors) {
        state.errors = errors
    },
    SET_PRODUCT_PAGINATION(state, pagination) {
        state.pagination = pagination
    },
    SET_PRODUCT_STATE(state, newState) {
        Object.assign(state, newState)
    }
}

let actions = {
    async getProducts({ state, commit }) {
        let response = await axios.get(`/products?page=${state.page}`)
        commit('SET_PRODUCTS', response.data.data)
        commit('SET_PRODUCT_PAGINATION', response.data.pagination)
    },
    async getProduct({ commit }, id) {
        try {
            let response = await axios.get(`/products/${id}`)
            commit('SET_PRODUCT', response.data.data)
        } catch (error) {
            if (error.response.status === 404) {
                commit('SET_PRODUCT', null)
            }
        }
    },

    async updateProduct({ commit }, payload) {
        try {
            await axios.put(`/products/${payload.id}`, payload.data)
            commit('SET_PRODUCT_ERRORS', [])
        } catch (error) {
            if (error.response.status === 422) {
                commit('SET_PRODUCT_ERRORS', error.response.data.errors)
            }
        }
    },

    async createProduct({ commit }, payload) {
        try {
            let response = await axios.post('/products', payload)
            commit('SET_PRODUCT', response.data.data)
            commit('SET_PRODUCT_ERRORS', [])
        } catch (error) {
            if (error.response.status === 422) {
                commit('SET_PRODUCT_ERRORS', error.response.data.errors)
            }
        }
    },
    async deleteProduct({ commit }, id) {
        await axios.delete(`/products/${id}`)
        commit('SET_PRODUCT', {})
    },
    resetProductState({ commit }) {
        commit('SET_PRODUCT_STATE', initState())
    }
}

export default {
    state,
    mutations,
    actions
}