
<template>

    <div class="form-group" v-bind:class="{ 'has-error': error }">

        <label v-if="label">
            {{ label }}
        </label>

        <label class="form-control btn btn-fill" v-bind:class="{ 'btn-info': item }" :readonly="disabled">
            <input type="checkbox" v-model="item" :disabled="disabled" :debounce="debounce">
            {{ text[item ? 1 : 0] }}
        </label>

        <span class="help-block">{{ error }}</span>

    </div>

</template>

<script>

    export default {

        props: {
        	debounce: null,
            label: null,
        	item: null,
        	error: null,
            disabled: null,
        	text: {
        		default: function () {
        			return ['Non', 'Oui']
        		},
        	},
        },

    }

</script>

<style scoped>

    .form-control {
        font-size: 14px;
        line-height: 22px;
    }

    input {
        display: none;
    }

</style>
