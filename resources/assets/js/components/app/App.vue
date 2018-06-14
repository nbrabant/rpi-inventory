
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
        mounted() {
            // console.log('Component mounted.')
        },

        data: function() {
            return {
                breadcrumbs: [],
            }
        },

        events: {
            'set-breadcrumbs': function (msg) {
                this.breadcrumbs = msg
            }
        },
    }

</script>
