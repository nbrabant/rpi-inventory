
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
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <router-link :to="{ name: 'product', params: { id: product.id } }" tag="tr" v-for="product in item.data" :key="product.id">
                        <td>{{ product.id }}</td>
                        <td>{{ product.name }}</td>
                        <td :class="product.status">{{ product.quantity }}</td>
                        <td>{{ product.updated_at | datetime }}</td>
                        <td class="text-right">
                            <router-link :to="{ name: 'consumptions-by-products', params: { product_id: product.id } }" tag="a" class="btn btn-primary" title="Voir les opérations">
                                <span class="fa fa-eye"></span>
                            </router-link>
                            <button class="btn btn-fill btn-success"  v-on:click="addProductToCart(product)" @click.capture="clicked" title="Ajouter à la liste de courses">
                                <span class="fa fa-shopping-cart"></span>
                            </button>
                        </td>
                    </router-link>
                </tbody>
            </table>

        </div>

        <html-pagination v-if="item.current_page"
            :current.sync="item.current_page"
            :last="item.last_page"
            :total="item.total" />

    </div>

</template>


<script>

    import RestList from '../../../../mixins/restlist'

    export default {

        mixins: [RestList],

        data() {
            return {};
        },

        methods: {
            clicked: function(e) {
                e.preventDefault();
            },
            addProductToCart: function(product) {
                this.HTTP.post('cartproducts', {
                        product_id: product.id,
                        quantity: 0,
                    })
                    .then(response => {
                        swal.fire({
                            title: "Ajouté !",
                            html: "le produit a été ajouté à la liste de courses.",
                            icon: "success"
                        });
                    }).catch(response => {
                        if (response.response.data.errors.product_id != undefined) {
                            swal.fire({
                                title: "Erreur !",
                                html: response.response.data.errors.product_id.join(','),
                                icon: "error"
                            });
                        } else {
                            swal.fire({
                                title: "Erreur !",
                                html: 'Erreur inconnue',
                                icon: "error"
                            });
                            console.log(response);
                        }
                    });
            }
        }
        
    }

</script>


<style scoped>

    tbody tr {
        cursor: pointer;
    }

</style>
