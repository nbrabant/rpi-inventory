
<template>

    <div class="clearfix">
        <div class="card">
            <html-cardheader title="Liste de courses"
                subtitle="Gestion des prochaines courses"
                :links="links"
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
                closeList: false,
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

                this.triggerRestSave('cartproducts', {}, this.item)

                // console.log(this);

                // and finally, bind item to list
                location.reload();
            },

        },

        components: {
            ShowCart,
        },

    })

</script>
