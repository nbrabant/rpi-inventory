
<template>

    <div class="card">

        <html-cardheader newtitle="Nouveau produit"
            :backroute="parentRoute"
            :newurl="newurl"
            title="Produits"
            subtitle="Liste des produits"></html-cardheader>

        <div class="content table-responsive table-full-width">

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Etat du stock</th>
                        <th>Dernière modification</th>
                    </tr>
                </thead>
                <tbody>
                    <router-link :to="{ name: 'product', params: { id: product.id } }" tag="tr" v-for="product in item.data" :key="product.id">
                        <td>{{ product.id }}</td>
                        <td>{{ product.nom }}</th>
                        <td :class="product.status">{{ product.quantite }}</th>
                        <td>{{ product.updated_at | datetime }}</td>
                    </router-link>
                </tbody>
            </table>

        </div>

        <html-pagination v-if="item.current_page"
            :current.sync="item.current_page"
            :last="item.last_page"
            :total="item.total"></html-pagination>

    </div>

</template>


<script>

    export default RestList.extend({

        data() {
            return {};
        },

    })

</script>


<style scoped>

    tbody tr {
        cursor: pointer;
    }

</style>
