<template>

    <div class="card">

        <div class="title">Aujourdh'hui</div>

        <section class="schedules">
            <div class="schedule clearfix" v-for="schedule in item.data" :key="schedule.id">
                <div class="schedule__body" :title="schedule.type_schedule" v-on:click="showDetails(schedule)">
                    <div class="col-xs-2">
                        <span class="fa fa-calendar" style="color:{schedule.color}"></span>
                    </div>
                    <div class="col-xs-10">
                        <div class="schedule__title">{{schedule.title|capitalize}}</div>
                        <div class="schedule__details">{{schedule.details}}</div>
                        <div class="schedule__period">{{schedule.start_at|time}} - {{schedule.end_at|time}}</div>
                    </div>
                </div>
            </div>
        </section>

    </div>

</template>

<script>

    import RestList from '../../../../mixins/restlist'

    export default {

        mixins: [RestList],

        mounted() {
            this.HTTP.get('schedules', {
                params: {
                    'search': {
                        'scope.byDateInterval': {
                            equal: {
                                startAt: moment().format('DD-MM-YYYY') + ' 00:00',
                                endAt: moment().format('DD-MM-YYYY') + ' 23:59',
                            }
                        }
                    }
                }
            }).then(response => {
                this.item = response.data
            })
        },

        computed: {
            endpoint: function() {
                return;
            }
        },

        methods: {
            showDetails: (schedule) => {
                let showDenyButton = (schedule.type_schedule == 'recette');

                swal.fire({
                    title: schedule.title,
                    icon: "info",
                    showDenyButton: showDenyButton,
                    denyButtonText: 'Voir',
                    customClass: {
                        denyButton: 'btn-warning'
                    }
                }).then((sweetAlertResult) => {
                    if (!sweetAlertResult) return;

                    if (sweetAlertResult.isDenied) {
                        // @TODO : Sanity check
                        // this.$router.push({name: 'schedule', params: { id: schedule.id }})
                    }
                })
            }
        }

    }

</script>

<style scoped>

    .title {
        text-align: center;
        font-size: 2rem;
        font-variant: small-caps;
        color: #999;
        padding: 10px 0;
    }

    .schedule {
        cursor: pointer;
        padding: 10px 0;
        border-bottom: 2px solid #E6E9ED;
        transition-property: background-color;
        transition-duration: 0.75s;
    }

    .schedule:hover {
        background-color: #eee;
    }

</style>
