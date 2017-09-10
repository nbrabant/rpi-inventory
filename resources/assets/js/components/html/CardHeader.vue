<template>

    <div class="header">

        <router-link v-if="newurl" :to="newurl" tag="a" class="btn btn-fill btn-success pull-right">
            <i class="fa fa-plus"></i>
            {{ newtitle }}
        </router-link>

        <router-link v-if="deletetitle" v-on:click="confirmDelete" :to="newurl" tag="a" class="btn btn-fill btn-warning pull-right">
            <i class="fa fa-trash"></i>
            {{ deletetitle }}
        </router-link>

        <router-link v-if="exporttitle && exporturl" :to="exporturl" class="btn btn-fill btn-default pull-right">
            <i class="fa fa-download"></i>
            {{ exporttitle }}
        </router-link>

        <router-link v-if="actionurl && actiontitle" :to="actionurl" class="btn btn-fill btn-primary pull-right">
            <i :class="'fa fa-' + actionicon"></i>
            {{ actiontitle }}
        </router-link>

        <router-link v-if="fronturl && fronttitle" target="_blank" :to="fronturl" class="btn btn-fill btn-primary pull-right">
            <i :class="'fa fa-' + fronticon"></i>
            {{ fronttitle }}
        </router-link>

        <h4 class="title">
            <router-link v-if="backroute" :to="backroute" tag="a" title="Retour">
                <i class="fa fa-chevron-left"></i>
            </router-link>
            {{ title }}
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
                default: false,
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
                this.$emit('confirm-delete')
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
