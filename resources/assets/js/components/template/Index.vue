
<template>

    <div class="wrapper">

        <html-sidebar></html-sidebar>

        <div class="main-panel">
            <html-navbar :breadcrumbs="breadcrumbs"></html-navbar>

            <div class="content clearfix">
                <router-view></router-view>
            </div>

            <html-pagefoot></html-pagefoot>

        </div>
            
    </div>

</template>



<script>

    export default {

        props: [
            'route',
            'title',
            'icon',
        ],

        route: {
            data: function () {
                this.$dispatch('set-breadcrumbs', [])
            },
        },

        events: {
            'set-breadcrumbs': function (msg) {
                msg.unshift({
                    route: this.route,
                    title: this.title,
                    icon: this.icon,
                })
                return true
            },
        },

    }

</script>
