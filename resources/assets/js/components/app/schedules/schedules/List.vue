
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
                    contentHeight: 'auto',
                    themeSystem: 'bootstrap4',
                    // refetchResourcesOnNavigate: true,
                    eventRender: (event, element) => {
                        // console.log(event)
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
                            icon: "info",
                            buttons: buttons
                        }).then((value) => {
                            if (!value) return;

                            if (value == "view") {
                                this.$router.push({name: 'show-recipe', params: { id: element.id }})
                            } else if (value == "modify") {
                                this.$router.push({name: 'schedule', params: { id: element.id }})
                            } else if (value == "delete") {

                            }

                            console.log(value);
                            return ;
                        })

                        // console.log(element.type_schedule == 'recette' ? 'redirect' : 'show');
                    },
                    // resources: (callback) => {
                    //     console.log('test');
                    //     this.callResources()
                    // }
                }
            }
        },

        // methods: {
        //     callResources() {
        //         console.log('called!!!');
        //         return this.item.data;
        //     }
        // },

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
