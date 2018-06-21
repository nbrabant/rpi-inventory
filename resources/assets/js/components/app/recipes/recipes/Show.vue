
<template>

    <form v-on:submit.prevent="submitForm">

        <div class="card">
            <html-cardheader :backroute="parentRoute"
                :title="title"></html-cardheader>
            <div class="content"></div>
        </div>

        <div class="card">

            <html-cardheader title="Informations de la recette"></html-cardheader>

            <div class="content clearfix">

                <div class="col-md-12">
                    <form-text label="Nom"
                        v-model="item.name"
                        :item="item.name"
                        :error="errors.name"></form-text>
                </div>

                <div class="col-md-4">
                    <form-text label="Nombre de personnes"
                        v-model="item.number_people"
                        :item="item.number_people"
                        :error="errors.number_people"></form-text>
                </div>

                <div class="col-md-4">
                    <form-text label="Temps de préparation"
                        v-model="item.preparation_time"
                        :item="item.preparation_time"
                        :error="errors.preparation_time"></form-text>
                </div>

                <div class="col-md-4">
                    <form-text label="Temps de cuisson"
                        v-model="item.cooking_time"
                        :item="item.cooking_time"
                        :error="errors.cooking_time"></form-text>
                </div>

<!--
<div class="form-group">
	{!! Form::label('visuel', 'Visuel', array('class' => 'col-md-3 control-label')) !!}
	<div class="col-md-9">
		{!! Form::file('visuel') !!}
		<p class="help-block">
			Format de fichier autorisé : JPG / PNG
		</p>
	</div>
</div>
-->

                <div class="col-md-12">
                    <form-textarea label="Instructions"
                        v-model="item.instructions"
                        :item="item.instructions"
                        :error="errors.instructions"></form-textarea>
                </div>

            </div>

        </div>

        <div class="card">
            <list-product
                :products="item.products"
                ></list-product>
        </div>

        <div class="card">
            <div class="content">
                <html-cardfooter :no-hr="true"
                    :updated-at="item.updated_at"
                    :submit-btn="submitBtn"
                    :submit-icon="submitIcon"
                    :submit-text="submitText"></html-cardfooter>
            </div>
        </div>

    </form>

</template>

<script>

    import ListProduct from './ListProduct.vue'

    export default RestShow.extend({

        computed: {
            title: function () {
                return this.item.id ? this.item.name : 'Nouvelle recette'
            },
        },

        components: {
            ListProduct,
        },

    })

</script>
