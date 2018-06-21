
<template>

    <div class="card">

        <html-cardheader
            title="Liste des ingrédients"></html-cardheader>

        <div class="content table-responsive table-full-width">

            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Quantité</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <tr v-for="product in item.products" :key="product.id">
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr> -->
                </tbody>
            </table>

        </div>

        <!-- product selection (autocomplete) -->

    </div>

</template>

<script>

    export default RestList.extend({

        // props: ['products'],

        data() {
            return {};
        },

    })

</script>

<style scoped>

    tbody tr {
        cursor: pointer;
    }

</style>
