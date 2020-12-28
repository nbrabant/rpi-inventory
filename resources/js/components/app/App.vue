
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
        data: function() {
            return {
                breadcrumbList: [],
            }
        }
    }

</script>
