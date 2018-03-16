
<template>

    <div class="card">
        <html-cardheader title="Rechercher un produit"></html-cardheader>

        <div class="content clearfix">

            <div class="col-md-11">
                <form-autocomplete
                    :suggestions="products"
                    v-model="selection"></form-autocomplete>
            </div>

            <div class="col-md-1">
                Rechercher
            </div>

        </div>

    </div>

</template>

<script>

    export default RestCore.extend({

        data: function() {
            return {
                selection: '',
                products: []
            };
        },

        mounted() {
            this.getRelatedResource('products', 'id', 'nom')
console.log(this.products);            
        },

        computed: {
            title: function () {
                return 'Consommations'
            }
        }

    })

</script>
