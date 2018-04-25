
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
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in item.product_lines" :key="product.id">
                            <td>{{ product.product.name }}</td>
                            <td>{{ product.quantity }}</td>
                            <td>{{ product.product.unit }}</td>
                            <td>Actions</td>
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
        }

    })

</script>
