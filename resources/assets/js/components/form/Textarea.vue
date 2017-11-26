
<template>

    <div class="form-group" v-bind:class="{ 'has-error': error }">

        <label v-if="label">
            {{ label }}
        </label>

        <textarea
            class="form-control"
            rows="5"
            :value="item"
            @input="updateItem($event.target.value)"
            :disabled="disabled"
            :placeholder="placeholder"
            :debounce="debounce"
            ref="input"></textarea>

        <span class="help-block">{{ error }}</span>

    </div>

</template>



<script>

    export default {
        props: ['debounce', 'label', 'item', 'error', 'disabled', 'placeholder'],

        methods: {
            updateItem: function(item) {
                this.$emit('input', item);
            }
        },
    }

</script>
