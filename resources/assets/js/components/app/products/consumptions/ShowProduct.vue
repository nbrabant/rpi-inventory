
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



    })

</script>
