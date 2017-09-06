<template>

    <div class="header">

        <a v-if="newtitle" v-link="newurl" class="btn btn-fill btn-success pull-right">
            <i class="fa fa-plus"></i>
            {{ newtitle }}
        </a>

        <a v-if="deletetitle" v-on:click="confirmDelete" class="btn btn-fill btn-warning pull-right">
            <i class="fa fa-trash"></i>
            {{ deletetitle }}
        </a>

        <a v-if="exporttitle && exporturl" :href="exporturl" class="btn btn-fill btn-default pull-right">
            <i class="fa fa-download"></i>
            {{ exporttitle }}
        </a>

        <a v-if="actionurl && actiontitle" v-link="{ path: actionurl }" class="btn btn-fill btn-primary pull-right">
            <i :class="'fa fa-' + actionicon"></i>
            {{ actiontitle }}
        </a>

        <a v-if="fronturl && fronttitle" target="_blank" :href="fronturl" class="btn btn-fill btn-primary pull-right">
            <i :class="'fa fa-' + fronticon"></i>
            {{ fronttitle }}
        </a>

        <h4 class="title">
            <a v-if="backroute" v-link="backroute" title="Retour">
                <i class="fa fa-chevron-left"></i>
            </a>
            {{ title | truncate }}
        </h4>

        <p v-if="subtitle" class="category">
            {{ subtitle }}
        </p>

    </div>

</template>



<script>

    export default {

        props: {
            newtitle: {},
            newurl: {
                default: function () { return { path: 'create', append: true } },
            },
            deletetitle: {},
            backroute: {},
            title: {},
            subtitle: {},
            exporttitle: {},
            exporturl: {},
            actionurl: {},
            actiontitle: {},
            actionicon: 'exchange',
            fronttitle: {},
            fronturl: {},
            fronticon: 'eye',
        },

        methods: {
            confirmDelete: function () {
                this.$dispatch('confirm-delete')
            },
        },

    }

</script>

<style scoped>
    a.btn
    {
        margin-left: 20px;
    }
</style>
