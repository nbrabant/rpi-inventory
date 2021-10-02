
<template>

    <div class="form-group" v-bind:class="{ 'has-error': error }">

        <label v-if="label">
            {{ label }}
        </label>

        <date-picker
            class="form-control"
            v-model="initialdatetime"
            @dp-change="setDatetime"
            :config="config"
            :disabled="disabled == 'disabled' ? 'disabled' : null"
            ref="input"></date-picker>

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

        props: ['label', 'initialdatetime', 'error', 'disabled', 'helper'],

        data() {
            return {
                config: {
                    format: 'YYYY-MM-DD HH:mm:ss',
                    useCurrent: false,
                    sideBySide: true,
                    toolbarPlacement: 'bottom',
                    showTodayButton: true,
                    showClear: true,
                },
            };
        },

        methods: {
            setDatetime: function() {
                this.$emit('change-date', this.initialdatetime);
            }
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
