
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
                    component: require('./../components/app/dashboard/Index.vue')
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
                    component: require('./../components/app/carts/Index.vue')
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
                    component: require('./../components/app/products/categories/List.vue')
                }, {
                    name: 'category',
                    path: ':id',
                    component: require('./../components/app/products/categories/Show.vue')
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
                    component: require('./../components/app/products/products/List.vue')
                }, {
                    name: 'product',
                    path: ':id',
                    component: require('./../components/app/products/products/Show.vue')
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
                    component: require('./../components/app/products/consumptions/Index.vue')
                }, {
                    name: 'consumptions-by-products',
                    path: 'product/:product_id',
                    component: require('./../components/app/products/consumptions/List.vue')
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
                    component: require('./../components/app/recipes/recipes/List.vue')
                }, {
                    name: 'show-recipe',
                    path: ':id',
                    component: require('./../components/app/recipes/recipes/View.vue')
                }, {
                    name: 'recipe',
                    path: ':id',
                    component: require('./../components/app/recipes/recipes/Show.vue')
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
                    component: require('./../components/app/schedules/schedules/List.vue')
                }, {
                    name: 'schedule',
                    path: ':id',
                    component: require('./../components/app/schedules/schedules/Show.vue')
                }
            ]
        }
    ]
});

// start routing
new Vue({
    el: '#app',
    router: router,
    render: h => h('router-view')
})
