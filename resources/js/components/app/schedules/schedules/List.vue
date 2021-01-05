
<template>

    <div class="clearfix">

        <div class="card">
            <html-cardheader newtitle="Nouvelle tâche"
                :backroute="parentRoute"
                :newurl="newurl"
                title="Agenda"
                subtitle="Liste des tâches"
                :actions="actions"></html-cardheader>
        </div>

        <div class="card clearfix">
            <full-calendar ref="calendar"
                :config="config"
                :event-sources="eventSources"
                :events="item.data" />
        </div>
    </div>

</template>

<script>

    // https://www.npmjs.com/package/vue-full-calendar
    import { FullCalendar } from 'vue-full-calendar'
    import RestList from '../../../../mixins/restlist'

    export default {

        mixins: [RestList],

        data() {
            return {
                eventSources: [{
                    events: (start, end, timezone, callback) => {
                        this.calendarDateRange = {start: start, end: end},
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
                actions: [
                    {
                        callback: () => {
                            this.exportToCart()
                        },
                        class: 'btn-primary',
                        icon: 'shopping-cart',
                        title: 'Export vers la liste de courses'
                    }
                ],
                range: {
                    start_at: null,
                    end_at: null,
                }
            };
        },

        computed: {
            endpoint: function () {
                return;
            },
            newurl: function() {
                return "create";
            },
            calendarDateRange: {
                get: function() {
                    return this.range
                },
                set: function(range) {
                    this.range = range
                }
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

        methods: {
            exportToCart: async function() {
                let value = await swal('Exporter vers la liste de courses', {
                    title: 'Exporter vers la liste de courses',
                    text: 'Cette action va ajouter les produits nécessaire aux recettes des semaines affichées à la liste de courses courante',
                    icon: "warning",
                    buttons: {
                        cancel: 'Fermer',
                        export: {
                            text: "Exporter",
                            value: "export",
                            closeModal: true,
                            className: "btn-primary",
                        },
                        cleanexport: {
                            text: "Purger et exporter",
                            value: "cleanexport",
                            closeModal: true,
                            className: "btn-primary",
                        }
                    }
                })

                if (!value) return;

                let response = await this.HTTP.post('schedules/export/cartlist', {
                    exportType: value,
                    dateRange: this.calendarDateRange
                }, this.item)

                if (response.status == 200) {
                    swal('Ajouté!', 'Produits ajoutés à la liste', 'success')
                } else {
                    swal(this.statusTexts[response.status], 'Erreur', 'error')
                }
            }
        },

        components: {
            FullCalendar
        }

    }

</script>

<style>

    @import '../../../../../../node_modules/fullcalendar/dist/fullcalendar.css';

    #calendar {
        margin: 2rem
    }

</style>
