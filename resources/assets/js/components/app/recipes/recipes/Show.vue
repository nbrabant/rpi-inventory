
<template>

    <form v-on:submit.prevent="submitForm">

        <div class="card">
            <html-cardheader :backroute="parentRoute"
                :title="title"></html-cardheader>
            <div class="content"></div>
        </div>

        <div class="card">

            <html-cardheader title="Informations de la recette"></html-cardheader>

            <div class="content clearfix">

                <div class="col-md-8">
                    <form-text label="Nom"
                        v-model="item.name"
                        :item="item.name"
                        :error="errors.name"></form-text>
                </div>

                <div class="col-md-4">
                    <form-select label="Type de recette"
                        :options="recipe_types"
                        v-model="item.recipe_type"
                        :item="item.recipe_type"
                        :error="errors.recipe_type"></form-select>
                </div>

                <div class="col-md-4">
                    <form-text label="Nombre de personnes"
                        v-model="item.number_people"
                        :item="item.number_people"
                        :error="errors.number_people"></form-text>
                </div>

                <div class="col-md-4">
                    <form-text label="Temps de préparation (minutes)"
                        v-model="item.preparation_time"
                        :item="item.preparation_time"
                        :error="errors.preparation_time"></form-text>
                </div>

                <div class="col-md-4">
                    <form-text label="Temps de cuisson (minutes)"
                        v-model="item.cooking_time"
                        :item="item.cooking_time"
                        :error="errors.cooking_time"></form-text>
                </div>

                <div class="col-md-12">
                    <form-image label="Visuel"
                        ref="image"
                        :imagesrc="imageSrc"
                        :item="item.visual"
                        :id="current_id_image"
                        :path="'assets/img/recipes'"
                        :error="errors.image"></form-image>
                </div>

            </div>

        </div>

        <div class="card">
            <list-product
                :recipeProducts="item.products"
                :errors="errors"></list-product>
        </div>

        <div class="card">
            <list-steps
                :recipeSteps="item.steps"
                :errors="errors"></list-steps>
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

    import ListProduct from './ListProduct.vue'
    import ListSteps from './ListSteps.vue'

    export default RestShow.extend({

        data: function() {
            return {
                item: {},
                errors: {},
                imageSrc: '',
            }
        },

        computed: {
            title: function () {
                return this.item.id ? this.item.name : 'Nouvelle recette'
            },
            recipe_types: function() {
                return [
                    {key: "entrée", value: "Entrée"},
                    {key: "plat", value: "Plat"},
                    {key: "dessert", value: "Dessert"},
                ];
            },
            current_id_image: function () {
                if (this.item.id)
                {
                    // var slug = Vue.filter('str_slug_fr');
                    // return slug(this.item.name) + "-" + this.item.id;
                }
            },
        },

        methods: {
            saveImage: function(input, id, url) {

            },
            addProduct: function(product) {
                this.item.products.push(product)
            },
            removeProduct: function(product) {
                var index = this.item.products.indexOf(product)
                this.item.products.splice(index, 1)
            },
            addStep: function() {
                this.item.steps.push({
                    name: '',
                    instruction: '',
                    position: 255
                });
            },
            removeStep: function(step) {
                var index = this.item.steps.indexOf(step)
                this.item.steps.splice(index, 1)
            },

            // beforeUpdate: function (params, item) {
            //     var inputFile = this.$refs.image.getInput();
            //
            //     var oData = new FormData();
            //
            //     // oData.append("_token", this.HTTP.options.headers['X-CSRF-TOKEN']);
            //     $.each(this.item, function( index, value ){
            //         oData.append(index, JSON.stringify(value));
            //     });
            //     if (typeof inputFile[0].files[0] != "undefined") {
            //         oData.append('image', inputFile[0].files[0]);
            //     }
            //     else {
            //         oData.append('image', JSON.stringify(this.item.visual));
            //     }
            //
            //     params.headers = {
            //         'content-type': 'multipart/form-data'
            //     };
            //
            //     item.image = oData;
            // }
        },

        events: {
            'updateImageSrc': function(render) {
                this.imageSrc = render
            }
        },

        components: {
            ListProduct,
            ListSteps,
        },

    })

</script>
