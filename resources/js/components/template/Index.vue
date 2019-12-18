
<template>

    <div class="wrapper">

        <html-sidebar></html-sidebar>

        <div class="main-panel">
            <html-navbar :breadcrumbs="breadcrumbs"></html-navbar>

            <div class="content clearfix">
                <router-view></router-view>
            </div>

            <html-pagefooter></html-pagefooter>

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

        data: function() {
            return {
                breadcrumbs: [],
            }
        },

        route: {
            data: function () {
                this.$emit('set-breadcrumbs', [])
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
