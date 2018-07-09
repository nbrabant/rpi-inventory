
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
            <!-- <Schedule
                :time-ground="['09:00', '18:00']"
                :week-ground="['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche']"
                :task-detail="[
                    [
                        {
                            dateStart: '09:30',
                            dateEnd: '11:30',
                            title: 'Course',
                            detail: 'Auchan'
                        }, {
    						dateStart: '08:30',
    						dateEnd: '10:30',
    						title: '开会',
    						detail: '开会',
    					}, {
    						dateStart: '11:00',
    						dateEnd: '12:00',
    						title: '开会',
    						detail: '开会',
    					},
                    ]
                ]"
                ></Schedule> -->
            <full-calendar :config="config" :events="item.events"/>
        </div>
    </div>

</template>

<script>

    // https://www.npmjs.com/package/vue-full-calendar
    import { FullCalendar } from 'vue-full-calendar'

    export default RestList.extend({

        data() {
            return {
                events: [
                    {
                        title: 'test',
                        allDay: true,
                        start: moment(),
                        end: moment().add(1, 'd'),
                    },
                    {
                        title: 'another test',
                        start: moment().add(2,'d'),
                        end: moment().add(2, 'd').add(2, 'h'),
                    },
                ],
            };
        },

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
