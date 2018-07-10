
<template>

    <div class="clearfix">

        <div class="card">
            <html-cardheader newtitle="Nouvelle tâche"
                :backroute="parentRoute"
                :newurl="newurl"
                title="Agenda"
                subtitle="Liste des tâches"></html-cardheader>
        </div>

        <div class="card clearfix">
            <full-calendar :config="config" :events="item.data"/>
        </div>
    </div>

</template>

<script>

    // https://www.npmjs.com/package/vue-full-calendar
    import { FullCalendar } from 'vue-full-calendar'

    export default RestList.extend({

        computed: {
            config: function() {
                console.log(moment());
                console.log(this.item.events);
                // console.log(this.events);
                // console.log(this.item.events);
                return {
                    locale: 'fr',
                    defaultView: 'agendaWeek',
                    eventRender: function(event, element) {
                        // console.log(event)
                    }
                }
            }
        },

        components: {
            FullCalendar,
        },

    })

</script>

<style>

    @import '~fullcalendar/dist/fullcalendar.css';

    .task-list-item {
        width: 100% !important;
    }

    .task-list-item h3 {
        font-size: 2rem;
    }

</style>
