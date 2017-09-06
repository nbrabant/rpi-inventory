
<template>

    <div class="sidebar" data-color="blue" data-image="back/sidebar.jpg">
        <div class="sidebar-wrapper">

            <div class="logo">
                <a href="" class="simple-text">
                    Rpi-inventory
                </a>
            </div>

            <ul class="nav">
                <li v-for="route in routes">
                    <router-link :to="{ name: route.route }">
                        <i :class="'fa fa-' + route.icon"></i>
                        <p>{{ route.title }}</p>
                    </router-link>
                </li>
            </ul>

        </div>
    </div>

</template>


<script>

    export default {

        data: function () {
            return {
                routes: [
                    {
                        route: 'dashboard',
                        title: 'Tableau de bord',
                        icon: 'pie-chart',
                    },
                ]
            }
        }
    }

</script>
