
<template>

    <div class="clearfix">

        <div class="card">

            <html-cardheader :backroute="parentRoute"
                title="Consommation par produits" />

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

        <div class="card">

            <div class="content table-responsive table-full-width">

                <html-cardheader title="Liste des opérations" />

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
                            <td>{{ operation.created_at }}</td>
                            <td>{{ operation.detail }}</td>
                            <td>{{ operation.operation | type-operation }}</td>
                            <td>{{ operation.quantity }}</td>
                        </tr>
                    </tbody>

                </table>

            </div>

            <html-pagination v-if="item.current_page"
                :current.sync="item.current_page"
                :last="item.last_page"
                :total="item.total"
                @changePage="pagination" />

        </div>

        <div class="card" v-if="item.id">

            <show-add-operation
                :productId="item.id">
            </show-add-operation>

        </div>

    </div>

</template>

<script>

    import ShowAddOperation from './ShowAddOperation.vue'
    import RestList from '../../../../mixins/restlist'

    export default {

        mixins: [RestList],

        data() {
            return {};
        },

        mounted: function() {
            this.triggerRestGet('consumptions/' + this.$route.path.split('/').slice(-1)[0])
        },

        computed: {
            // override to escape the parent mounted request
            endpoint: function () {
                return;
            },
        },

        components: {
            ShowAddOperation
        }

    }

</script>

<style scoped>

    tbody tr {
        cursor: pointer;
    }

</style>
