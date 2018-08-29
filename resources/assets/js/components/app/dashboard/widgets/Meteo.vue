<template>

    <a class="weatherwidget-io"
        :href="wheaterUrl"
        :data-label_1="title"
        :data-label_2="subtitle"
        data-icons="Climacons Animated"
        data-theme="weather_one" >TOURCOING Méteo</a>

</template>

<script>

    // https://weatherwidget.io/

    export default {

        data() {
            return {
                wheaterUrl: "https://forecast7.com/en/50d723d16/tourcoing/",
                title: "TOURCOING",
                subtitle: "Météo"
            };
        },

    }

</script>
