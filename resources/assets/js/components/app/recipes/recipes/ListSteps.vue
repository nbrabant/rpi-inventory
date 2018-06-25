
<template>

    <div class="clearfix">

        <html-cardheader
            title="Liste des instructions"></html-cardheader>


        <div class="clearfix" v-if="recipeSteps">
            <button type="button" class="btn btn-success pull-right" v-on:click="addToList()">
                <span class="fa fa-plus"></span>
                Ajouter une instruction
            </button>

            <ul class="content list-group">

                <li class="list-group-item" v-for="step in recipeSteps" :key="step.id">
                    <div class="clearfix">
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
            addToList: function() {
                this.$parent.addStep();
            },
            removeFromList: function(step) {
                this.$parent.removeStep(step);
            },

        }

    })

</script>
