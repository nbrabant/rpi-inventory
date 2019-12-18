
<template>

    <div class="form-group" v-bind:class="{ 'has-error': error }">

        <label v-if="label">
            {{ label }}
        </label>

        <select
            type="select"
            class="form-control"
            :value="item"
            @input="updateItem($event.target.value)"
            v-model="item"
            :disabled="disabled"
            :placeholder="placeholder"
            :debounce="debounce"
            ref="input">

            <option v-if="withEmptyOption">---</option>
            <option v-for="option in options" :value="option.key">
                {{ option.value }}
            </option>

        </select>

        <span class="help-block">{{ error }}</span>

    </div>

</template>

<script>

    export default {

        props: ['debounce', 'label', 'item', 'error', 'disabled', 'options', 'withEmptyOption', 'placeholder'],

        methods: {
            updateItem: function(item) {
                this.$emit('input', item);
            }
        },

    }

</script>
