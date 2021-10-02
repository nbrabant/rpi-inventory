<template>

    <div id="time-clock" class="clearfix">
        <div class="time-clock__date">{{ date }}</div>
        <div class="time-clock__time">{{ time }}</div>
    </div>

</template>

<script>

    import moment from 'moment-timezone';

    export default {

        data() {
            return {
                date: '',
                time: '',
            };
        },

        created() {
            this.refreshTime();
            setInterval(this.refreshTime, 1000);
        },

        methods: {
            refreshTime() {
                this.date = moment()
                    .tz('Europe/Paris')
                    .format('DD-MM-YYYY');
                this.time = moment()
                    .tz('Europe/Paris')
                    .format('HH:mm:ss');
            },
        }
    }

</script>

<style scoped>

    #time-clock::before {
        display: inline-block;
        font: normal normal normal 4rem FontAwesome;
        content: "\F017";
        text-align: center;
        color: #999;
        width: 100%;
    }

    #time-clock {
        padding: 1rem 0 2rem;
        background-color: #eee;
    }

    [class^="time-clock"] {
        text-align: center;
    }

    [class$="__date"] {
        font-size: 3rem;
    }

    [class$="__time"] {
        font-size: 2rem;
    }

</style>
