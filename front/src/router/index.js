import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component: require('@/pages/index').default,
    },
    {
      path: '/products',
      name: 'products',
      component: require('@/pages/products/index').default,
    },
    {
        path: '/products/:id/edit',
        name: 'product-edit',
        component: require('@/pages/products/edit').default,
    },
    {
        path: '/products/create',
        name: 'product-create',
        component: require('@/pages/products/create').default,
    },
    {
        path: '/categories',
        name: 'categories',
        component: require('@/pages/categories/index').default,
    },
    {
        path: '/categories/:id/edit',
        name: 'category-edit',
        component: require('@/pages/categories/edit').default,
    },
    {
        path: '/categories/create',
        name: 'category-create',
        component: require('@/pages/categories/create').default,
    },
    {
        path: '*',
        redirect: '/404'
    },
    {
        path: '/404',
        name: '404',
        component: require('@/pages/errors/404').default,
    }
  ]
})
