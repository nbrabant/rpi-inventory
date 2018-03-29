
<template>

    <form v-on:submit.prevent="submitForm">

        <div class="card">
            <html-cardheader
                title="nouvelle opération"></html-cardheader>
        </div>

        <div class="card">
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

    module.exports = RestShow.extend({

        props: ['productId'],

        computed: {
            endpoint: function () {
                if (this.productId == null) return

                return this.$route.path.split('/').slice(-2, -1)[0] + '/create'
            },
        },

        mounted: function() {
            if (this.endpoint == undefined) return

            this.triggerRestGet(this.endpoint, {id: this.productId}, this.item)
        },

    });

</script>
