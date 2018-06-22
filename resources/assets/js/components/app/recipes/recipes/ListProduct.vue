
<template>

    <div class="card">

        <html-cardheader
            title="Liste des ingrédients"></html-cardheader>

        <div class="content table-responsive table-full-width">

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Quantité</th>
                        <th>Unité</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" :key="product.id">
                        <td>{{ product.product_name }}</td>
                        <td>{{ product.quantity }}</td>
                        <td>{{ product.unit }}</td>
                        <td>
                            <a href="#" class="btn btn-danger pull-right" v-on:click="removeFromList()">
                                <span class="fa fa-close"></span>
                                Supprimer
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>

</template>

<script>

    export default RestList.extend({

        props: ['products'],

        data() {
            return {};
        },

        computed: {
            endpoint: function() {
                return;
            }
        },

        methods: {
            removeFromList: function() {
                console.log('test');
            }
        }

    })

</script>

<style scoped>

    tbody tr {
        cursor: pointer;
    }

</style>
