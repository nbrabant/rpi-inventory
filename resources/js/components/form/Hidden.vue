
<template>

    <div class="form-group">

        <input
            type="hidden"
            class="form-control"
            v-model="item">

    </div>

</template>



<script>

    export default {
        props: ['item'],
    }

</script>
