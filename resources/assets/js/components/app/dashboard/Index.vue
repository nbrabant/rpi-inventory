
<template>

    <div class="card">

        <html-cardheader
            title="Accueil"></html-cardheader>

        <div class="content clearfix">

            Bienvenue sur le rpi-inventory

        </div>

    </div>

</template>

<script>

    export default {
        route: {
            data: function () {
                this.$dispatch('set-breadcrumbs', [])
            },
        },
    }

</script>
