
<template>

    <div class="card">

        <html-cardheader newtitle="Nouvelle catégorie"
            :backroute="parentRoute"
            :newurl="newurl"
            title="Catégories"
            subtitle="Liste des catégories organisant les produits"></html-cardheader>

        <div class="content table-responsive table-full-width">

            <!-- @TODO : change to grid component -->
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Dernière modification</th>
                    </tr>
                </thead>
                <tbody>
                    <router-link v-for="category in item.data" 
                        :key="category.id"
                        :to="{ name: 'category', params: { id: category.id } }" 
                        tag="tr">
                        
                        <td>{{ category.id }}</td>
                        <td>{{ category.name }}</td>
                        <td>{{ category.updated_at | datetime }}</td>
                    </router-link>
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

    import RestList from '../../../../mixins/restlist'

    export default {

        mixins: [RestList],

        data() {
            return {};
        },

    }

</script>


<style scoped>

    tbody tr {
        cursor: pointer;
    }

</style>
