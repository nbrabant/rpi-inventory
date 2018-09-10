
<template>

    <div class="clearfix">
        <div class="card">
            <html-cardheader title="Liste de courses"
                subtitle="Gestion des prochaines courses"
                :links="links"
                :actions="actions"
            ></html-cardheader>
        </div>

        <div class="card">
            <html-cardheader title="Rechercher un produit"></html-cardheader>

            <div class="content clearfix">

                <div class="col-md-12">
                    <form-autocomplete
                        :suggestions="products"
                        v-model="selection"
                        v-on:updateSelection="updateSelection"
                        placeholder="Saisir le produit"
                        :error="errors.product_id"
                    ></form-autocomplete>
                </div>

            </div>
        </div>

        <ShowCart ref="cartlist"></ShowCart>
    </div>

</template>

<script>

    import ShowCart from './ShowCart.vue'

    export default RestShow.extend({

        data: function() {
            return {
                selection: '',
                products: [],
                productId: null,
                actions: [
                    {
                        callback: () => { this.closeList() },
                        class: 'btn-danger',
                        icon: 'exchange',
                        title: 'Clore cette liste'
                    }
                ],
                links: [
                    {
                        route: 'cart/export/pdf',
                        class: 'btn-info',
                        icon: 'file-pdf-o',
                        title: 'Export en PDF'
                    }, {
                        route: 'cart/export/mail',
                        class: 'btn-info',
                        icon: 'envelope',
                        title: 'Export par mail'
                    }, {
                        route: 'cart/export/trello',
                        class: 'btn-info',
                        icon: 'trello',
                        title: 'Export vers Trello'
                    }
                ]
            };
        },

        mounted() {
            this.getRelatedResource('products', 'id', 'name')
        },

        computed: {
            isDisabled: function () {
                return this.selectedKey == undefined || this.selectedKey == ''
            },
            endpoint: function () {
                return;
            },
        },

        methods: {
            updateSelection: function(payload) {
                this.productId = payload.key
                this.item.product_id = payload.key
                this.item.quantity = 0

                this.triggerRestSave(this.$route.path.split('/').slice(-2, -1)[0], {}, this.item)

                // console.log(this);

                // and finally, bind item to list
                location.reload();
            },

            closeList: (event) => {
                swal('Cloturer liste', {
                    title: 'Cloture de la liste courante',
                    html: 'Cette action va cloturer la liste de courses courante et effectuer les opérations de stock, êtes-vous sûr?',
                    icon: "warning",
                    buttons: {
                        cancel: 'Fermer',
                        closelist: {
                            text: "Cloturer",
                            value: "closelist",
                            closeModal: true,
                            className: "btn-warning",
                        }
                    }
                }).then((value) => {
                    this.HTTP.post('edit', {

                    })
                }).then((response) => {
                    console.log(response);
                });
            }
        },

        components: {
            ShowCart,
        },

    })

</script>
