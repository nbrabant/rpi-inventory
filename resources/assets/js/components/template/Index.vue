
<template>

    <div>
        <router-view></router-view>
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
