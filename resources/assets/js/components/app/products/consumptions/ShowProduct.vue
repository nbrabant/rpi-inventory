
<template>

    <div class="card">

        <div class="content clearfix">
            <div v-if="productId">
                <input v-model="productId" type="hidden">

                <div class="card">
                    <html-cardheader :title="title"></html-cardheader>
                    <div class="content">
                        <p>{{ item.description }}</p>
                        <p>Quantité actuelle : {{ item.quantity }}</p>
                        <p>Quantité mini de réaprovisionnement : {{ item.min_quantity }}</p>
                    </div>
                </div>

                <div class="clearfix" v-if="hasOperations">
                    <html-cardheader title="Liste des opérations"></html-cardheader>

                    <!-- <show-consumption></show-consumption> -->

                    <show-operation v-for="(operation, key) in item.operations"
                        :key="key"
                        :operation="operation">
                    </show-operation>
                </div>

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
            },
            title: function() {
                if (this.productId == null) return ''

                return this.item.name;
            },
            hasOperations: function() {
                return this.item.operations != undefined && this.item.operations.length > 0;
            }
        },

        watch: {
            productId: function() {
                if (this.productId == null) return null

                this.triggerRestGet(this.endpoint, {id: this.productId}, this.item)
            }
        },

    })

</script>
