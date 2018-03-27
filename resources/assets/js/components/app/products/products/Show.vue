
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
                        v-model="item.category_id"
                        :item="item.category_id"
                        withEmptyOption="true"
                        :error="errors.category_id"></form-select>
                </div>

                <div class="col-md-12">
                    <form-text label="Nom"
                        v-model="item.name"
                        :item="item.name"
                        :error="errors.name"></form-text>
                </div>

                <div class="col-md-12">
                    <form-textarea label="Description"
                        v-model="item.description"
                        :item="item.description"
                        :error="errors.description"></form-textarea>
                </div>

                <div class="col-md-12">
                    <form-text label="Quantité minimum"
                        v-model="item.min_quantity"
                        :item="item.min_quantity"
                        :error="errors.min_quantity"></form-text>
                </div>

                <div class="col-md-12">
                    <form-select label="Unité"
                        :options="unites"
                        v-model="item.unit"
                        :item="item.unit"
                        withEmptyOption="true"
                        :error="errors.unit"></form-select>
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

    <!-- @TODO : ADD operations -->

</template>

<script>

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
            this.getRelatedResource('categories', 'id', 'name')
        },

        computed: {
            title: function () {
                return this.item.id ? this.item.name : 'Nouveau produit'
            },
        },
    })

</script>
