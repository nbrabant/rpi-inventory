
<template>

    <div class="clearfix">

        <html-cardheader
            title="Liste des instructions"></html-cardheader>

        <div class="clearfix content">
            <button type="button" class="btn btn-success pull-right" v-on:click="addToList()">
                <span class="fa fa-plus"></span>
                Ajouter une instruction
            </button>
        </div>

        <div class="clearfix" v-if="recipeSteps">

            <ul class="content list-group">

                <li class="list-group-item" v-for="step in recipeSteps" :key="step.id">
                    <div class="clearfix">
                        <form-hidden
                            v-model="step.id"
                            :item="step.id"></form-hidden>

                        <div class="col-md-8">
                            <form-text label="Etape"
                                v-model="step.name"
                                :item="step.name"
                                :error="errors.name"></form-text>
                        </div>

                        <div class="col-md-4">
                            <button type="button" class="btn btn-danger pull-right" v-on:click="removeFromList(step)">
                                <span class="fa fa-close"></span>
                                Supprimer
                            </button>
                        </div>

                        <div class="col-md-12">
                            <form-textarea label="Instructions"
                                v-model="step.instruction"
                                :item="step.instruction"
                                :error="errors.instruction"></form-textarea>
                        </div>
                    </div>
                </li>

            </ul>

        </div>

    </div>

</template>

<script>

    export default RestList.extend({

        props: ['recipeSteps', 'errors'],

        computed: {
            endpoint: function() {
                return;
            },
        },

        methods: {
            removeFromList: function(step) {
                this.$parent.removeStep(step);
            },
            addToList: function() {
                this.$parent.addStep();
            },
        },

    })

</script>
