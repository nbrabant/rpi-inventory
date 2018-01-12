
import VueRouter from 'vue-router';
Vue.use(VueRouter)

// Configure vue-router
var router = new VueRouter({
    linkActiveClass: 'active',
    hashbang: false,
    saveScrollPosition: true,
    routes: [
        // {
        //     path: '*',
        //     redirect: { name: 'dashboard' }
        // },
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
            path: '/categories',
            component : {
                template: '<div><template-index route="/categories" title="Catégories" icon="list-alt"></template-index></div>',
            },
            children: [
                {
                    name: 'categories',
                    path: '/',
                    component: require('./../components/app/categories/List.vue')
                }, {
                    name: 'category',
                    path: ':id',
                    component: require('./../components/app/categories/Show.vue')
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
                    component: require('./../components/app/products/List.vue')
                }, {
                    name: 'product',
                    path: ':id',
                    component: require('./../components/app/products/Show.vue')
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
                    component: require('./../components/app/consumptions/List.vue')
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
