
<template>

    <div class="clearfix">

        <div class="card">
            <html-cardheader newtitle="Nouvelle tâche"
                :backroute="parentRoute"
                :newurl="newurl"
                title="Agenda"
                subtitle="Liste des tâches"
                :links="links"></html-cardheader>
        </div>

        <div class="card clearfix">
            <full-calendar :config="config" :event-sources="eventSources" :events="item.data" />
        </div>
    </div>

</template>

<script>

    // https://www.npmjs.com/package/vue-full-calendar
    import { FullCalendar } from 'vue-full-calendar'

    export default RestList.extend({

        data() {
            return {
                eventSources: [{
                    events: (start, end, timezone, callback) => {
                        this.HTTP.get('schedules', {
                            params: {
                                'search': {
                                    'scope.byDateInterval': {
                                        equal: {
                                            startAt: start,
                                            endAt: end,
                                        }
                                    }
                                }
                            }
                        }).then(response => {
                            callback(response.data.data)
                        })
                    }
                }],
                links: [
                    {
                        route: 'schedules/export/cartlist',
                        class: 'btn-primary',
                        icon: 'shopping-cart',
                        title: 'Export vers la liste de courses'
                    }
                ]
            };
        },

        computed: {
            endpoint: function () {
                return;
            },
            newurl: function() {
                return "create";
            },
            config: function() {
                return {
                    locale: 'fr',
                    defaultView: 'agendaWeek',
                    contentHeight: 'auto',
                    themeSystem: 'bootstrap4',
                    refetchResourcesOnNavigate: true,
                    eventDrop: (event, delta)  => {
                        this.HTTP.patch('schedules/' + event.id, {
                                type_schedule: event.type_schedule,
                                title: event.title,
                                start_at: moment(event.start_at).add(delta).format('YYYY-MM-DD HH:mm:ss'),
                                end_at: moment(event.end_at).add(delta).format('YYYY-MM-DD HH:mm:ss'),
                                all_day: event.all_day,
                            }, null)
                            .then(response => {
                                console.log(event);
                            }).catch(response => {
                                console.log(response);
                            });
                    },
                    eventClick: (element, jsEvent, view) => {
                        let buttons = {
                            cancel: 'Fermer',
                            modify: {
                                text: "Modifier",
                                value: "modify",
                                closeModal: true,
                                className: "btn-warning",
                            }
                        }

                        if (element.type_schedule == 'recette') {
                            buttons.view = {
                                text: 'Voir',
                                value: 'view',
                                closeModal: true
                            }
                        }

                        swal(element.title, {
                            title: element.title,
                            text: element.details,
                            icon: "info",
                            buttons: buttons
                        }).then((value) => {
                            if (!value) return;

                            if (value == "view") {
                                this.$router.push({name: 'show-recipe', params: { id: element.id }})
                            } else if (value == "modify") {
                                this.$router.push({name: 'schedule', params: { id: element.id }})
                            } else if (value == "delete") {
                                // console.log(value);
                            }

                            return ;
                        })
                    },
                }
            },
        },

        components: {
            FullCalendar,
        },

    })

</script>

<style>

    @import '~fullcalendar/dist/fullcalendar.css';

    #calendar {
        margin: 2rem
    }

</style>
