
<template>

    <form v-on:submit.prevent="submitForm">

        <div class="card">
            <html-cardheader :backroute="parentRoute"
                :title="title"></html-cardheader>
            <div class="content"></div>
        </div>

        <div class="card">

            <html-cardheader title="Informations de la catégorie"></html-cardheader>

            <div class="content clearfix">

                <div class="col-md-12">
                    <form-text label="Nom"
                        v-model="item.name"
                        :item="item.name"
                        :error="errors.name"></form-text>
                </div>

            </div>

        </div>

        <div class="card">
            <div class="content">
                <html-cardfooter :no-hr="true"
                    :updated-at="item.updated_at"
                    :submit-btn="submitBtn"
                    :submit-icon="submitIcon"
                    :submit-text="submitText"></html-cardfooter>
            </div>
        </div>

    </form>

</template>

<script>

    import RestShow from '../../../../mixins/restshow'

    export default {

        mixins: [RestShow],

        computed: {
            title: function () {
                return this.item.id ? this.item.name : 'Nouvelle catégorie'
            },
        }

    }

</script>
