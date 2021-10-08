<template>

    <div class="card">

        <html-cardheader :backroute="parentRoute"
                         title="Configurations"
                         subtitle="Configuration de l'application"></html-cardheader>

        <div class="content table-responsive table-full-width">

        </div>

    </div>

</template>

<script>

    import RestList from '../../../mixins/restlist'

    export default {

        mixins: [RestList],

        data() {
            return {};
        }

    }

</script>
