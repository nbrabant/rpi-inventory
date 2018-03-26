
<template>

    <div class="card">

        <div class="content clearfix">
            <div v-if="product">
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

        props: ['product'],

        computed: {
            endpoint: function () {
                if (this.product == null) return

                return this.$route.path.split('/').slice(-2, -1)[0] + '/' + this.product.id
            }
        },

        mounted: function() {
            // this.triggerRestGet(this.endpoint, {id: this.$route.params.id}, this.item)
        },

    })

</script>
