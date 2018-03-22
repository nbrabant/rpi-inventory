
<template>

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

</template>

<script>

    export default RestCore.extend({

        data: function() {
            return {
                selection: '',
                selectedKey: '',
                products: []
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

                
            },
            updateSelection: function(payload) {
                this.selectedKey = payload.key
            }
        },

    })

</script>
