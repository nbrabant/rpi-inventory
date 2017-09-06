
import VueRouter from 'vue-router';
Vue.use(VueRouter)

import DashboardIndex from './../components/app/dashboard/Index.vue';

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
                    component: DashboardIndex
                }
            ]
        }
    ]
});

export default router
