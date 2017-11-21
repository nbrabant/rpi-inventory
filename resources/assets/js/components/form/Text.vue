
<template>

    <div class="form-group" v-bind:class="{ 'has-error': error }">

        <label v-if="label">
            {{ label }}
        </label>

        <input
            type="text"
            class="form-control"
            :value="item"
            @input="updateItem($event.target.value)"
            :disabled="disabled"
            :placeholder="placeholder"
            :size="size"
            :debounce="debounce"
            ref="input">

        <span class="help-block">{{ error }}</span>

    </div>

</template>



<script>

    export default {

        data: function() {
            return {
                search_text: '',
                is_complete: false,
            }
        },

        props: ['debounce', 'label', 'item', 'error', 'disabled', 'placeholder', 'size', 'id'],

        methods: {
            updateItem: function(item) {
                this.$emit('input', item);
            }
        },
    }

</script>
