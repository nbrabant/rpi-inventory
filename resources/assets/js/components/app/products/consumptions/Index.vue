
<template>

    <div class="clearfix">
        <div class="card">
            <html-cardheader title="Rechercher un produit"></html-cardheader>

            <div class="content clearfix">

                <div class="col-md-10">
                    <form-autocomplete
                        :suggestions="products"
                        v-model="selection"
                        v-on:updateSelection="updateSelection"
                        placeholder="Saisir le produit"
                    ></form-autocomplete>
                </div>

                <div class="col-md-2">
                    <form-button
                        label="Rechercher"
                        :onClick="searchConsumptions"
                        :disabled="isDisabled"
                    ></form-button>
                </div>

            </div>
        </div>

        <ShowProduct
            :product="product">
        </ShowProduct>
    </div>

</template>

<script>

    import ShowProduct from './ShowProduct.vue'

    export default RestCore.extend({

        data: function() {
            return {
                selection: '',
                selectedKey: '',
                products: [],
                product: null
            };
        },

        mounted() {
            this.getRelatedResource('products', 'id', 'nom')
        },

        computed: {
            isDisabled: function () {
                return this.selectedKey == undefined || this.selectedKey == ''
            },
        },

        methods: {
            searchConsumptions() {
                if (this.isDisabled) {
                    return;
                }

                this.triggerRestGet('products', {'id': this.selectedKey}, this)
            },
            updateSelection: function(payload) {
                this.selectedKey = payload.key
                this.selection = payload.value
            }
        },

        components: {
            ShowProduct
        },

    })

</script>
