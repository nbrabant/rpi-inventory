
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
                    <form-select label="Catégorie"
                        :options="categories"
                        v-model="item.categorie_id"
                        :item="item.categorie_id"
                        withEmptyOption="true"
                        :error="errors.categorie_id"></form-select>
                </div>

                <div class="col-md-12">
                    <form-text label="Nom"
                        v-model="item.nom"
                        :item="item.nom"
                        :error="errors.nom"></form-text>
                </div>

                <div class="col-md-12">
                    <form-textarea label="Description"
                        v-model="item.description"
                        :item="item.description"
                        :error="errors.description"></form-textarea>
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
                    {key: 'piece', value: 'Pièce'},
                    {key: 'grammes', value: 'Grammes'},
        			{key: 'litre', value: 'Litre'},
        			{key: 'sachet', value: 'Sachet'},
                ],
                categories: []
            }
        },

        mounted() {
            this.getRelatedResource('categories', 'id', 'nom')
        },

        computed: {
            title: function () {
                return this.item.id ? this.item.nom : 'Nouveau produit'
            },
        },
    })

</script>
