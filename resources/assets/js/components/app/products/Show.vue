
<template>

    <form v-on:submit.prevent="submitForm">

        <div class="card">
            <html-cardheader :backroute="parentRoute"
                :title="title"></html-cardheader>
            <div class="content"></div>
        </div>

        <div class="card">

            <html-cardheader title="Informations du produit"></html-cardheader>

            <div class="content clearfix">

                <div class="col-md-12">
                    <form-text label="Nom"
                        v-model="item.nom"
                        :item="item.nom"
                        :error="errors.nom"></form-text>
                </div>

                <div class="col-md-12">
                    <form-text label="Quantité minimum"
                        v-model="item.quantite_min"
                        :item="item.quantite_min"
                        :error="errors.quantite_min"></form-text>
                </div>

                <div class="col-md-12">
                    <form-select label="Unité"
                        :options="unites"
                        v-model="item.unite"
                        :item="item.unite"
                        withEmptyOption="true"
                        :error="errors.unite"></form-select>
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

    import {RestShow} from './../../services/show'

    export default RestShow.extend({

        data: function() {
            return {
                unites: [
                    {key: 'grammes', value: 'Grammes'},
        			{key: 'litre', value: 'Litre'},
        			{key: 'sachet', value: 'Sachet'},
                ]
            }
        },

        computed: {
            title: function () {
                return this.item.id ? this.item.nom : 'Nouveau produit'
            },
        }

    })

</script>
