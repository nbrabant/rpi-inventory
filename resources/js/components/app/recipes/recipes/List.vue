
<template>

    <div class="card">

        <html-cardheader newtitle="Nouvelle recette"
            :backroute="parentRoute"
            :newurl="newurl"
            title="Recettes"
            subtitle="Liste des recettes"></html-cardheader>

        <div class="content table-responsive table-full-width">

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Nb personnes</th>
                        <th>Temps cuisson</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <router-link :to="{ name: 'recipe', params: { id: recipe.id } }" tag="tr" v-for="recipe in item.data" :key="recipe.id">
                        <td>{{ recipe.id }}</td>
                        <td>{{ recipe.name }}</td>
                        <td>{{ recipe.number_people }}</td>
                        <td>{{ recipe.preparation_time }}</td>
                        <td>
                            <router-link :to="{ name: 'show-recipe', params: { id: recipe.id } }" tag="a" class="btn btn-primary pull-right" title="Voir la recette">
                                <span class="fa fa-eye"></span>
                            </router-link>
                        </td>
                    </router-link>
                </tbody>
            </table>

        </div>

        <html-pagination v-if="item.current_page"
            :current.sync="item.current_page"
            :last="item.last_page"
            :total="item.total" />

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
