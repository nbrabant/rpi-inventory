
<template>

    <div class="clearfix">

        <html-cardheader
            title="Liste des ingrédients"></html-cardheader>

        <div class="content table-responsive table-full-width">

            <table class="table table-hover table-striped" v-if="recipeProducts">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Quantité</th>
                        <th>Unité</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in recipeProducts" :key="product.id">
                        <td>{{ product.product_name }}</td>
                        <td>
                            <form-text
                                v-model="product.quantity"
                                :item="product.quantity"
                                :error="errors.quantity"></form-text>
                        </td>
                        <td>
                            <form-select
                                :options="units"
                                v-model="product.unit"
                                :item="product.unit"
                                :error="errors.unit"></form-select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger pull-right" v-on:click="removeFromList(product)">
                                <span class="fa fa-close"></span>
                                Supprimer
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        <div class="col-md-12">
            <form-autocomplete v-if="products"
                :suggestions="products"
                v-model="selection"
                v-on:updateSelection="updateSelection"
                placeholder="Saisir le produit"
            ></form-autocomplete>
        </div>

    </div>

</template>

<script>

    export default RestList.extend({

        props: ['recipeProducts', 'errors'],

        data() {
            return {
                selection: '',
                products: [],
            };
        },

        computed: {
            endpoint: function() {
                return;
            },
            isDisabled: function () {
                return this.selectedKey == undefined || this.selectedKey == ''
            },
            units: function() {
                return [
                    {key: "grammes", value: "Grammes"},
                    {key: "litre", value: "Litre"},
                    {key: "centilitre", value: "Centilitre"},
                    {key: "cuilliere_cafe", value: "Cuillere à Cafe"},
                    {key: "cuilliere_dessert", value: "Cuillere à Dessert"},
                    {key: "cuilliere_soupe", value: "Cuillere à Soupe"},
                    {key: "verre_liqueur", value: "Verre à liqueur"},
                    {key: "verre_moutarde", value: "Verre à moutarde"},
                    {key: "grand_verre", value: "Grand verre"},
                    {key: "tasse_cafe", value: "Tasse à café"},
                    {key: "bol", value: "Bol"},
                    {key: "sachet", value: "Sachet"},
                    {key: "gousse", value: "Gousse"},
                ];
            }
        },

        mounted() {
            this.getRelatedResource('products', 'id', 'name')
        },

        methods: {
            removeFromList: function(product) {
                this.$parent.removeProduct(product);
            },
            updateSelection: function(payload) {
                var exists = this.recipeProducts.filter(function(elem) {
                    if (elem.product_id == payload.key) return elem;
                });

                if (exists.length > 0) return;

                let product = {
                    product_id: payload.key,
                    product_name: payload.value,
                }

                this.$parent.addProduct(product)
            }
        }

    })

</script>

<style scoped>

    tbody tr {
        cursor: pointer;
    }

</style>
