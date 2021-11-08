<template>

    <form v-on:submit.prevent="submitForm">

        <div class="card">
            <html-cardheader
                    :backroute="parentRoute"
                    title="Configurations"
                    subtitle="Configuration de l'application"></html-cardheader>
        </div>

        <div class="card" v-for="(configurations, prefix) in item">
            <html-cardheader
                    :title="prefix|capitalize"
                    :no-hr="false"/>

            <div class="col-md-12" v-for="(value, key) in configurations">
                <form-text :label="key"
                           v-model="key"
                           :item="value"
                           :error="errors.key"></form-text>
            </div>
        </div>

        <div class="card">
            <div class="content">
                <html-cardfooter :no-hr="true"
                    :submit-btn="submitBtn"
                    :submit-icon="submitIcon"
                    :submit-text="submitText"></html-cardfooter>
            </div>
        </div>

    </form>

</template>

<script>

    import RestShow from '../../../mixins/restshow'

    export default {

        mixins: [RestShow],

        data() {
            return {};
        },

        computed: {
            submitText: function () {
                return 'Enregistrer'
            }
        }

    }

</script>
