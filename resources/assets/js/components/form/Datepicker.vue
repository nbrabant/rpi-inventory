
<template>

    <div class="form-group" v-bind:class="{ 'has-error': error }">

        <label v-if="label">
            {{ label }}
        </label>

        <date-picker v-model="item" :config="config"></date-picker>


        <!-- <input
            type="text"
            class="form-control"
            v-datepicker="item"
            :disabled="disabled == 'disabled' ? 'disabled' : null"> -->

        <span class="help-block">
            {{ helper }}
            {{ error }}
        </span>

    </div>

</template>

<script>
    // Import required dependencies
    import 'bootstrap/dist/css/bootstrap.css';

    // Import this component
    import datePicker from 'vue-bootstrap-datetimepicker';

    // Import date picker css
    import 'eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css';

    export default {
        props: ['label', 'item', 'error', 'disabled', 'helper'],

        computed: {
            config: function() {
                return {};
            }
        },

        methods: {
        //     getInput: function(msg, event) {
        //         return this.$el.querySelectorAll("input[type='text']");
        //     },
        //
        //     clearValue: function() {
        //         var datepicker = this.getInput()
        //         console.log(datepicker)
        //     },
        },

        components: {
            'date-picker': datePicker
        }

    }
</script>

<style>
    .form-group {
        position: relative;
    }
</style>
