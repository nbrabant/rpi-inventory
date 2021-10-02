
<template>

    <div class="clearfix">

        <div class="col-sm-4">
            <widget-meteo />
        </div>

        <div class="col-sm-4">
            <time-clock />
        </div>

        <div class="col-sm-4">
            <day-schedules />
        </div>

    </div>

</template>

<script>

    import WidgetMeteo from './widgets/Meteo.vue'
    import TimeClock from './widgets/TimeClock.vue'
    import DaySchedules from './widgets/DaySchedules.vue'

    export default {

        components: {
            WidgetMeteo,
            TimeClock,
            DaySchedules
        }

    }

</script>
