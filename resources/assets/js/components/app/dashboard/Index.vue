
<template>

    <div class="card">

        <html-cardheader
            title="Accueil"></html-cardheader>

        <div class="content clearfix">

            Bienvenue sur le rpi-inventory

            <div class="col-sm-4">
                <widget-meteo></widget-meteo>
            </div>

        </div>

    </div>

</template>

<script>

    import WidgetMeteo from './widgets/Meteo.vue'

    export default {

        route: {
            data: function () {
                this.$emit('set-breadcrumbs', [])
            },
        },

        components: {
            WidgetMeteo
        }

    }

</script>
