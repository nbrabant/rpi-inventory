
<template>

    <div class="card">

        <div class="content clearfix">
            <div v-if="productId">
                <input v-model="productId" type="hidden">
                <div>{{ item.nom }}</div>
                toto
            </div>
            <div v-else>
                Aucun produit sélectionné
            </div>
        </div>

    </div>

</template>

<script>

    module.exports = RestShow.extend({

        props: ['productId'],

        computed: {
            endpoint: function () {
                if (this.productId == null) return

                return this.$route.path.split('/').slice(-2, -1)[0]
            }
        },

        watch: {
            productId: function() {
                if (this.productId == null) return null

                this.triggerRestGet(this.endpoint, {id: this.productId}, this.item)
            }
        },

        methods: {
            getProduct: function() {

            }
        }

    })

</script>
