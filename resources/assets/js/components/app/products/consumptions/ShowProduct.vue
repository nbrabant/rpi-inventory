
<template>

    <div class="clearfix">

        <div v-if="productId">
            <input v-model="productId" type="hidden">

            <div class="card">
                <div class="clearfix">
                    <div class="col-sm-12">
                        <h1>{{ item.name }}</h1>
                    </div>
                    <div class="col-sm-12">{{ item.description }}</div>
                    <div class="clearfix">
                        <div class="col-sm-5">
                            Quantité actuelle
                        </div>
                        <div class="col-sm-7">
                            {{ item.quantity }} {{ item.unit }}
                        </div>
                    </div>
                    <div class="clearfix">
                        <div class="col-sm-5">
                            Quantité mini de réapprovisionnement
                        </div>
                        <div class="col-sm-7">
                            {{ item.min_quantity }} {{ item.unit }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card" v-if="hasOperations">
                <html-cardheader title="Liste des opérations"></html-cardheader>

                <table class="table table-hover table-striped">

                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Détail</th>
                            <th>Type d'opération</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="operation in item.operations" :key="operation.id">
                            <th>{{ operation.created_at }}</th>
                            <th>{{ operation.detail }}</th>
                            <th>{{ operation.operation | type-operation }}</th>
                            <th>{{ operation.quantity }}</th>
                        </tr>
                    </tbody>

                </table>
            </div>

            <div class="card">
                <show-add-operation
                    :productId="productId">
                </show-add-operation>
            </div>

        </div>
        <div v-else>
            Aucun produit sélectionné
        </div>

    </div>

</template>

<script>

    import ShowOperation from './ShowOperation.vue'
    import ShowAddOperation from './ShowAddOperation.vue'

    export default RestShow.extend({

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

        components: {
            ShowOperation,
            ShowAddOperation,
        },

    })

</script>
