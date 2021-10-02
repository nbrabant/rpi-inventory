
<template>

    <div class="card">
        <html-cardheader title="Liste actuelle"
            :actions="actions" />

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
                        <tr v-for="product in item.product_lines" :key="product.id" 
                            :class="product.created ? 'newitem' : ''">
                            
                            <td>{{ product.product.name }}</td>
                            <td>
                                <form-text
                                    v-model="product.quantity"
                                    :item="product.quantity"
                                    :error="errors.quantity" />
                            </td>
                            <td>{{ product.product.unit }}</td>
                            <td class="pull-right">
                                <button v-on:click="updateLine(product)" class="btn btn-fill btn-primary" title="Modifier">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button v-on:click="removeLine(product)" class="btn btn-fill btn-danger" title="Supprimer">
                                    <i class="fa fa-trash"></i>
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

    import RestShow from '../../../mixins/restshow'

    export default {

        mixins: [RestShow],

        data: function() {
            return {
                actions: [
                    {
                        callback: () => {
                            this.closeList()
                        },
                        class: 'btn-danger',
                        icon: 'exchange',
                        title: 'Clore cette liste'
                    }
                ]
            };
        },

        computed: {
            endpoint: function () {
                return this.$route.path.split('/').slice(-2, -1)[0]
            },
            hasProductLines: function () {
                return this.item.product_lines != undefined && this.item.product_lines.length > 0;
            },
        },

        methods: {
            removeLine(product) {
                this.confirmRestDelete("Suppression du produit du panier de courses", 'cartproducts', {
                    'product_id': product.product_id
                })

                // and finally, remove item from list
                // let idx = this.item.product_lines.findIndex(i => i.product_id === product.product_id)
                // this.item.product_lines.splice(idx, 1)
            },
            updateLine(product) {
                this.triggerRestUpdate('cartproducts', {
                    cart_id: product.cart_id
                }, product)
            },
            closeList() {
                swal.fire({
                    title: 'Cloture de la liste courante',
                    html: 'Cette action va cloturer la liste de courses courante et effectuer les opérations de stock, êtes-vous sûr?',
                    icon: "warning",
                    showConfirmButton: true,
                    confirmButtonText: 'Cloturer',
                    showCancelButton: true,
                    confirmCancelText: 'Annuler',
                    customClass: {
                        confirmButton: 'btn-danger'
                    }
                }).then(sweetAlertResult => {
                    if (!sweetAlertResult || !sweetAlertResult.isConfirmed) return;

                    this.HTTP.patch(this.endpoint + '/' + this.item.id, {
                        finished: true
                    }, this.item)
                    .then(response => {
                        console.log(response);
                    }).catch(response => {
                        console.log(response);
                    });

                }).catch(response => {
                    console.log(response);
                })
            }
        }

    }

</script>

<style scoped>

    .newitem {
        animation: newItemAnimation 2s;
        -webkit-animation: newItemAnimation 2s;
    }

</style>
