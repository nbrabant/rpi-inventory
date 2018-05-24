
<template>

    <div class="card">
        <html-cardheader title="Liste de courses"></html-cardheader>

        <div class="content clearfix">

            <div v-if="hasProductLines">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <td>Nom</td>
                            <td>Quantité</td>
                            <td>Unité / Conditionnement</td>
                            <td class="pull-right">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in item.product_lines" :key="product.id">
                            <td>{{ product.product.name }}</td>
                            <td>{{ product.quantity }}</td>
                            <td>{{ product.product.unit }}</td>
                            <td class="pull-right">
                                <button v-on:click="removeLine(product)" class="btn btn-fill btn-warning pull-right">
                                    <i class="fa fa-trash"></i>
                                    Supprimer
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="alert alert-warning" v-else>
                Aucun produit dans la liste de course actuellement.
            </div>

        </div>
    </div>

</template>

<script>

    export default RestShow.extend({

        computed: {
            endpoint: function () {
                return this.$route.path.split('/').slice(-2, -1)[0]
            },
            hasProductLines: function () {
                return this.item.product_lines != undefined && this.item.product_lines.length > 0;
            }
        },

        methods: {
            removeLine(product) {
                this.confirmRestDelete("Suppression du produit du panier de courses", this.endpoint, {
                    'product_id': product.id
                })

                // and finally, remove item from list
            }
        }

    })

</script>
