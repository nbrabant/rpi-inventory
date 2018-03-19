
<template>

    <div class="card">
        <html-cardheader title="Rechercher un produit"></html-cardheader>

        <div class="content clearfix">

            <div class="col-md-10">
                <form-autocomplete
                    :suggestions="products"
                    :itemKey="selectionKey"
                    v-model="selection"
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
                selectionKey: '',
                products: []
            };
        },

        mounted() {
            this.getRelatedResource('products', 'id', 'nom')
        },

        computed: {
            isDisabled: function () {
console.log(this.selectedKey);

                return this.selectionKey.length <= 0
            },
        },

        methods: {
            searchConsumptions() {
                console.log('Button clicked')
            }
        }

    })

</script>
