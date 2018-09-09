<template>

    <div class="header">

        <!-- for not RestFul actions -->
        <a v-for="link in links" :key="link.route"
            :href="link.route"
            :class="'btn btn-fill ' + link.class + ' pull-right'"
            :title="link.title">
            <i :class="'fa fa-' + link.icon"></i>
        </a>

        <button v-for="action in actions" v-on:click="action.action" :class="'btn btn-fill ' + action.class + ' pull-right'" :title="action.title">
            <i :class="'fa fa-' + action.icon"></i>
        </button>

        <router-link v-if="newurl" :to="newurl" tag="a" class="btn btn-fill btn-success pull-right">
            <i class="fa fa-plus"></i>
            {{ newtitle }}
        </router-link>

        <router-link v-if="deletetitle" v-on:click="confirmDelete" :to="newurl" tag="a" class="btn btn-fill btn-warning pull-right">
            <i class="fa fa-trash"></i>
            {{ deletetitle }}
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
            actions: {},
            links: {},
            newtitle: {},
            newurl: {
                default: false,
            },
            deletetitle: {},
            backroute: {},
            title: {},
            subtitle: {},
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
    button.btn
    {
        z-index: 1;
    }
</style>
