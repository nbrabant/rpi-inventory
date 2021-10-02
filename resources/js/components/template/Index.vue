
<template>

    <div class="wrapper">

        <html-sidebar />

        <div class="main-panel">
            <html-navbar :breadcrumbList="breadcrumbList" />

            <div class="content clearfix">
                <router-view />
            </div>

            <html-pagefooter />

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
                breadcrumbList: [],
            }
        },

        mounted() {
            this.updateCrumbs()
        },

        watch: {
            '$route': function() { this.updateCrumbs() }
        },

        methods: {
            updateCrumbs: function() {
                this.breadcrumbList = this.$route.meta.breadcrumb
            }
        }

    }

</script>
