
<template>

    <div class="clearfix">
        <div class="card clearfix">
            <html-cardheader :backroute="parentRoute"
                :title="title"></html-cardheader>
            <div class="content col-md-12 table-responsive">
                <table class="table table-hover table-striped">
                    <tr>
                        <td class="table-label">Type de recette</td>
                        <td class="text-right">{{ item.recipe_type | type-recette }}</td>
                        <td class="table-label">Nombre de personnes</td>
                        <td class="text-right">{{ item.number_people | people }}</td>
                    </tr>
                    <tr>
                        <td class="table-label">Temps de préparation</td>
                        <td class="text-right">{{ item.preparation_time | convert-time }}</td>
                        <td class="table-label">Temps de cuisson</td>
                        <td class="text-right">{{ item.cooking_time | convert-time }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <html-cardheader
                title="Ingrédients"></html-cardheader>
            <div class="content">
                <ul>
                    <li v-for="product in item.products" :key="product.id">
                        - {{ product.quantity }} {{ product.unit }} {{ product.name }}
                    </li>
                </ul>
            </div>
        </div>

        <div class="card">
            <html-cardheader
                title="Instructions"></html-cardheader>
            <div class="content">
                <html-slider
                    :slides="getSlides"
                ></html-slider>
            </div>
        </div>

    </div>

</template>

<script>

    import RestShow from '../../../../mixins/restshow'

    export default {

        mixins: [RestShow],

        computed: {
            title: function () {
                return this.item.id ? this.item.name : 'Nouvelle recette'
            },
            getSlides: function() {
                if (!this.item.steps) {
                    return [];
                }

                return this.item.steps.map(function(step) {
                    return '<div class="slide-title">' + step.name + '</div> \
                            <div class="slide-content">' + step.instruction + '</div>'
                })
            }
        }
    }

</script>

<style scoped>
    table td {
        padding: 0.5rem;
    }
    table td.table-label {
        font-weight: bold;
    }
    table td.table-label:after {
        content: " :";
    }
    
</style>
