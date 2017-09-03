<template>
    <div class="wrapper">

        <html-sidebar></html-sidebar>

        <div class="main-panel">

            <html-navbar :breadcrumbs="breadcrumbs"></html-navbar>

            <div class="panel panel-default">
                <div class="panel-heading">Example Component</div>

                <div class="panel-body">
                    I'm an example component!
                </div>
            </div>

            <html-pagefooter></html-pagefooter>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
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
