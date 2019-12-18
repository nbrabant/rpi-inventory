
<template>

    <form v-on:submit.prevent="submitForm">

        <div class="card">
            <html-cardheader :backroute="parentRoute"
                :title="title"></html-cardheader>
            <div class="content"></div>
        </div>

        <div class="card">

            <html-cardheader title="Informations de la tâche"></html-cardheader>

            <div class="content clearfix">

                <div class="col-md-12">
                    <form-text label="Titre"
                        v-model="item.title"
                        :item="item.title"
                        :error="errors.title"></form-text>
                </div>

                <div class="col-md-5">
                    <form-datepicker label="Débute à"
                        :initialdatetime="item.start_at"
                        :error="errors.start_at"
                        v-on:change-date="item.start_at = $event"></form-datepicker>
                </div>

                <div class="col-md-5">
                    <form-datepicker label="Termine à"
                        :initialdatetime="item.end_at"
                        :error="errors.end_at"
                        v-on:change-date="item.end_at = $event"></form-datepicker>
                </div>

                <div class="col-md-2">
                    <form-checkbox label="Toute la journée"
                        :item="item.all_day"
                        :error="errors.all_day"></form-checkbox>
                </div>

                <div class="col-md-12">
                    <form-select label="Type de tâche"
                        :options="type_schedules"
                        v-model="item.type_schedule"
                        :item="item.type_schedule"
                        :error="errors.type_schedule"></form-select>
                </div>

                <div class="col-md-12" v-if="isRecette">
                    <form-select label="Recette"
                        :options="recipes"
                        v-model="item.recipe_id"
                        :item="item.recipe_id"
                        :error="errors.recipe_id"></form-select>
                </div>

                <div class="col-md-12">
                    <form-textarea label="Détails"
                        v-model="item.details"
                        :item="item.details"
                        :error="errors.details"></form-textarea>
                </div>

            </div>

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

    export default RestShow.extend({

        data: function() {
            return {
                type_schedules: [
                    {key: 'recette', value: 'Recette'},
                    {key: 'rendezvous', value: 'Rendez-vous'},
                    {key: 'planning', value: 'Planning'},
                ],
                recipes: []
            }
        },

        mounted() {
            this.getRelatedResource('recipes', 'id', 'name')
        },

        computed: {
            title: function () {
                return this.item.id ? this.item.title : 'Nouvelle tâche'
            },

            isRecette: function () {
                return this.item.type_schedule == 'recette';
            }
        },

    })

</script>
