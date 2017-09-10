
<template>

    <div class="form-group" v-bind:class="{ 'has-error': error }">

        <label v-if="label">
            {{ label }}
        </label>

        <input type="text" class="form-control" v-model="item" :disabled="disabled" :placeholder="placeholder" :size="size" :debounce="debounce">

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

    }

</script>
