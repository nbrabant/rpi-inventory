
<template>

    <div class="card">

        <html-cardheader
            title="Accueil"></html-cardheader>

        <div class="content clearfix">

            Bienvenue sur le rpi-inventory

            <div class="col-sm-4">
                <widget-meteo></widget-meteo>
            </div>

            <div class="col-sm-4">
                <time-clock></time-clock>
            </div>

        </div>

    </div>

</template>

<script>

    import WidgetMeteo from './widgets/Meteo.vue'
    import TimeClock from './widgets/TimeClock.vue'

    export default {

        route: {
            data: function () {
                this.$emit('set-breadcrumbs', [])
            },
        },

        components: {
            WidgetMeteo,
            TimeClock
        }

    }

</script>
