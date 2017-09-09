
<template>

    <div class="card">

        <html-cardheader newtitle="Nouvelle catégorie"
            :backroute="parentRoute"
            title="Catégories"
            subtitle="Liste des catégories organisant les produits"></html-cardheader>

        <div class="content table-responsive table-full-width">

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th name="id">
                            ID
                        </th>
                        <th name="nom">
                            Nom
                        </th>
                        <th name="updated_at">
                            Dernière modification
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in item.data" v-link="{ path: category.id, append: true }">
                        <td>{{ category.id }}</td>
                        <td>{{ category.nom }}</th>
                        <td>{{ category.updated_at | datetime }}</td>
                    </tr>
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

    import RestList from './../../../rest/list'

    export default {

        data() {
            return {
                item: [],
                category: {
                    id: '',
                    ordre: ''
                }
            };
        },

        mixins: [RestList],

        mounted() {
            this.fetchList()
        },

        computed: {
            title: function () {
                return this.item.id ? this.item.name : 'Nouvelle catégorie'
            },
            parentRoute: function () {
                return this.$route.path.split('/').slice(0, -1).join('/')
            },
        },

        methods: {
            fetchList() {
                axios.get('api/categories').then((res) => {
                    this.item = res.data;
                });
            },
        },

        // route: {
        //     data: function () {
        //         this.$dispatch('set-breadcrumbs', [])
        //     },
        // },

    }

</script>


<style scoped>

    tbody tr {
        cursor: pointer;
    }

</style>
