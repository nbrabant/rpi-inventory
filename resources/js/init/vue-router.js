
import VueRouter from 'vue-router';

Vue.use(VueRouter)

// Configure vue-router
var router = new VueRouter({
    linkActiveClass: 'active',
    hashbang: false,
    saveScrollPosition: true,
    routes: [
        {
            path: '*',
            redirect: { name: 'dashboard' }
        },
        {
            path: '/dashboard',
            component : {
                template: '<div><template-index route="/dashboard" title="Tableau de bord" icon="pie-chart"></template-index></div>',
            },
            children: [
                {
                    name: 'dashboard',
                    path: '/',
                    component: () => import("../components/app/dashboard/Index.vue"),
                    meta: {
                        breadcrumb: [
                            { name: 'Dashboard', icon: 'home' }
                        ]
                    }
                }
            ]
        },
        {
            path: '/carts',
            component : {
                template: '<div><template-index route="/carts" title="Liste de course" icon="shopping-cart"></template-index></div>',
            },
            children: [
                {
                    name: 'carts',
                    path: '/',
                    component: () => import('../components/app/carts/Index.vue'),
                    meta: {
                        breadcrumb: [
                            { name: 'Dashboard', link: '/', icon: 'home' },
                            { name: 'Cart' }
                        ]
                    }
                }
            ]
        },
        {
            path: '/categories',
            component : {
                template: '<div><template-index route="/categories" title="Catégories" icon="list-alt"></template-index></div>',
            },
            children: [
                {
                    name: 'categories',
                    path: '/',
                    component: () => import('../components/app/products/categories/List.vue'),
                    meta: {
                        breadcrumb: [
                            { name: 'Dashboard', link: '/', icon: 'home' },
                            { name: 'Categories' }
                        ]
                    }
                }, {
                    name: 'category',
                    path: ':id',
                    component: () => import('../components/app/products/categories/Show.vue'),
                    meta: {
                        breadcrumb: [
                            { name: 'Dashboard', link: '/', icon: 'home' },
                            { name: 'Categories', link: '/categories/' },
                            { name: 'Category' },
                        ]
                    }
                }
            ]
        },
        {
            path: '/products',
            component : {
                template: '<div><template-index route="/products" title="Produits" icon="list-alt"></template-index></div>',
            },
            children: [
                {
                    name: 'products',
                    path: '/',
                    component: () => import('../components/app/products/products/List.vue'),
                    meta: {
                        breadcrumb: [
                            { name: 'Dashboard', link: '/', icon: 'home' },
                            { name: 'Products' }
                        ]
                    }
                }, {
                    name: 'product',
                    path: ':id',
                    component: () => import('../components/app/products/products/Show.vue'),
                    meta: {
                        breadcrumb: [
                            { name: 'Dashboard', link: '/', icon: 'home' },
                            { name: 'Products', link: '/products/' },
                            { name: 'Product' }
                        ]
                    }
                }
            ]
        },
        {
            path: '/consumptions',
            component : {
                template: '<div><template-index route="/consumption" title="Consommation" icon="tachometer"></template-index></div>',
            },
            children: [
                {
                    name: 'consumptions',
                    path: '/',
                    component: () => import('../components/app/products/consumptions/Index.vue'),
                    meta: {
                        breadcrumb: [
                            { name: 'Dashboard', link: '/', icon: 'home' },
                            { name: 'Consumptions' }
                        ]
                    }
                }, {
                    name: 'consumptions-by-products',
                    path: 'product/:product_id',
                    component: () => import('../components/app/products/consumptions/List.vue'),
                    meta: {
                        breadcrumb: [
                            { name: 'Dashboard', link: '/', icon: 'home' },
                            { name: 'Product consumption' }
                        ]
                    }
                }
            ]
        },
        {
            path: '/recipes',
            component : {
                template: '<div><template-index route="/recipe" title="Recettes" icon="cutlery"></template-index></div>',
            },
            children: [
                {
                    name: 'recipes',
                    path: '/',
                    component: () => import('../components/app/recipes/recipes/List.vue'),
                    meta: {
                        breadcrumb: [
                            { name: 'Dashboard', link: '/', icon: 'home' },
                            { name: 'Recipes' }
                        ]
                    }
                }, {
                    name: 'show-recipe',
                    path: ':id',
                    component: () => import('../components/app/recipes/recipes/View.vue'),
                    meta: {
                        breadcrumb: [
                            { name: 'Dashboard', link: '/', icon: 'home' },
                            { name: 'Recipes', link: '/recipes/' },
                            { name: 'Recipes' }
                        ]
                    }
                }, {
                    name: 'recipe',
                    path: ':id',
                    component: () => import('../components/app/recipes/recipes/Show.vue'),
                    meta: {
                        breadcrumb: [
                            { name: 'Dashboard', link: '/', icon: 'home' },
                            { name: 'Recipes', link: '/recipes/' },
                            { name: 'Recipes' }
                        ]
                    }
                }
            ]
        }, {
            path: '/schedules',
            component: {
                template: '<div><template-index route="/recipe" title="Recettes" icon="calendar"></template-index></div>',
            },
            children: [
                {
                    name: 'schedules',
                    path: '/',
                    component: () => import('../components/app/schedules/schedules/List.vue'),
                    meta: {
                        breadcrumb: [
                            { name: 'Dashboard', link: '/', icon: 'home' },
                            { name: 'Schedules' },
                        ]
                    }
                }, {
                    name: 'schedule',
                    path: ':id',
                    component: () => import('../components/app/schedules/schedules/Show.vue'),
                    meta: {
                        breadcrumb: [
                            { name: 'Dashboard', link: '/', icon: 'home' },
                            { name: 'Schedules', link: '/schedules/' },
                            { name: 'Schedule' }
                        ]
                    }
                }
            ]
        }, {
            path: '/configurations',
            component: {
                template: '<div><template-index route="/configuration" title="Configuration" icon="cog"></template-index></div>',
            },
            children: [
                {
                    name: 'configurations',
                    path: '/',
                    component: () => import('../components/app/configurations/List.vue'),
                    meta: {
                        breadcrumb: [
                            {name: 'Dashboard', link: '/', icon: 'home'},
                            {name: 'Configuration'},
                        ]
                    }
                }
            ]
        }
    ]
});

// start routing
const app = new Vue({
    router,
    render: h => h('router-view')
}).$mount('#app');