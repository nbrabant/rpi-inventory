
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
    // import Schedule from "./modal/Schedule";
    import RestList from '../../../../mixins/restlist'

    export default {

        mixins: [RestList],

        data() {
            return {
                eventSources: [{
                    events: (fetchInfo, successCallback, failureCallback) => {
                        this.calendarDateRange = {
                            start: fetchInfo.start.valueOf(),
                            end: fetchInfo.end.valueOf()
                        },
                        this.HTTP.get('schedules', {
                            params: {
                                'search': {
                                    'scope.byDateInterval': {
                                        equal: {
                                            startAt: fetchInfo.start.valueOf(),
                                            endAt: fetchInfo.end.valueOf(),
                                        }
                                    }
                                }
                            }
                        }).then(response => {
                            successCallback(response.data.data)
                        }).catch(error => {
                            failureCallback(error.message)
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
                    eventResize: (info) => {
                        this.updateEvent(info);
                    },
                    eventDrop: (info)  => {
                        this.updateEvent(info);
                    },
                    eventClick: (info) => {
                        this.displayEvent(info);
                    }
                }
            },
        },

        methods: {
            exportToCart: async function() {
                //@TODO : use daterange
                let sweetAlertResult = await swal.fire({
                    title: 'Exporter vers la liste de courses',
                    html: 'Cette action va ajouter les produits nécessaire aux recettes des semaines affichées à la liste de courses courante',
                    icon: "warning",
                    showConfirmButton: true,
                    confirmButtonText: 'Exporter',
                    showDenyButton: true,
                    denyButtonText: 'Purger et exporter',
                    showCancelButton: true,
                    confirmCancelText: 'Annuler',
                    customClass: {
                        confirmButton: 'btn-primary',
                        denyButton: 'btn-primary'
                    }
                });

                let exportType;
                if (sweetAlertResult.isConfirmed) {
                    exportType = "export";
                } else if (sweetAlertResult.isDenied) {
                    exportType = "cleanexport";
                } else {
                    return;
                }

                let response = await this.HTTP.post('schedules/export/cartlist', {
                    exportType: exportType,
                    dateRange: this.calendarDateRange
                }, this.item);

                if (response.status == 200) {
                    swal.fire({
                        title: 'Ajouté!',
                        html: 'Produits ajoutés à la liste',
                        icon: 'success'
                    });
                } else {
                    swal.fire({
                        title: this.statusTexts[response.status],
                        html: 'Erreur',
                        icon: 'error'
                    });
                }
            },
            updateEvent: async function(info) {
                await this.HTTP.patch('schedules/' + info.event.id, {
                    type_schedule: info.event.extendedProps.type_schedule,
                    title: info.event.title,
                    details: info.event.extendedProps.details,
                    recipe_id: info.event.extendedProps.recipe_id,
                    start_at: moment(info.event.start).format('YYYY-MM-DD HH:mm:ss'),
                    end_at: moment(info.event.end).format('YYYY-MM-DD HH:mm:ss'),
                    all_day: info.event.extendedProps.all_day,
                }, null)
                    .then(response => {
                        console.log(info.event);
                    }).catch(response => {
                        console.log(response);
                    });
            },
            displayEvent: function(info) {
                let showDenyButton = (info.event.extendedProps.type_schedule == 'recette');

                swal.fire({
                    title: info.event.title,
                    html: info.event.extendedProps.details,
                    icon: "info",
                    showConfirmButton: true,
                    confirmButtonText: 'Modifier',
                    showDenyButton: showDenyButton,
                    denyButtonText: 'Voir',
                    showCancelButton: true,
                    confirmCancelText: 'Fermer',
                    customClass: {
                        denyButton: 'btn-warning'
                    }
                }).then((sweetAlertResult) => {
                    if (!sweetAlertResult) return;

                    if (sweetAlertResult.isConfirmed) {
                        this.$router.push({name: 'show-recipe', params: { id: info.event.id }})
                    } else if (sweetAlertResult.isDenied) {
                        this.$router.push({name: 'schedule', params: { id: info.event.id }})
                    } else if (sweetAlertResult.isDismissed) {
                        console.log(sweetAlertResult);
                    }
                });
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
