
<template>

    <button
        class="btn btn-primary"
        @click="onClick"
        :disabled="disabled">

        <slot>{{ label }}</slot>

    </button>

</template>

<script>

    export default {

        props: {
            onClick: {
                type: Function,
                required: true
            },
            label: {
                type: String,
                required: true
            },
            disabled: {
                type: Boolean
            }
        },

    }

</script>

<style scoped>
    .btn[disabled] {
        background-color: #3097D1;
    }
</style>
