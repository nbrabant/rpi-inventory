
<template>

    <div class="clearfix">
        <div class="card">
            <html-cardheader title="Rechercher un produit"></html-cardheader>

            <div class="content clearfix">

                <div class="col-md-12">
                    <form-autocomplete
                        :suggestions="products"
                        v-model="selection"
                        v-on:updateSelection="updateSelection"
                        placeholder="Saisir le produit"
                    ></form-autocomplete>
                </div>

            </div>
        </div>

        <ShowCart></ShowCart>
    </div>

</template>

<script>

    import ShowCart from './ShowCart.vue'

    export default RestCore.extend({

        data: function() {
            return {
                selection: '',
                products: [],
                productId: null
            };
        },

        mounted() {
            this.getRelatedResource('products', 'id', 'name')
        },

        computed: {
            isDisabled: function () {
                return this.selectedKey == undefined || this.selectedKey == ''
            },
        },

        methods: {
            updateSelection: function(payload) {
                this.productId = payload.key
            }
        },

        components: {
            ShowCart,
        },

    })

</script>
