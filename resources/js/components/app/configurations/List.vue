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
                <html-cardfooter
                        :no-hr="true"
                        :updated-at="item.updated_at"
                        :submit-btn="submitBtn"
                        :submit-icon="submitIcon"
                        :submit-text="submitText"></html-cardfooter>
            </div>
        </div>

    </form>

</template>

<script>

    import RestList from '../../../mixins/restlist'

    export default {

        mixins: [RestList],

        data() {
            return {};
        }

    }

</script>
