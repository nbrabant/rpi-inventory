
<template>

    <div class="footer clearfix">

        <hr>

        <div class="row">
            <div class="col-sm-4">
                {{ total > 0 ? total : 'Aucun' }} enregistrement{{ total > 1 ? 's' : '' }}
                <template v-if="last > 0 && first != last">
                    - Page {{ current }} sur {{ last }}
                </template>
            </div>
            <div class="col-sm-8">
                <ul v-if="last > 0 && first != last" class="btn-group pull-right">
                    <li v-on:click="goTo(previous)" aria-label="Prédédent" class="btn btn-info">
                        <span aria-hidden="true">&laquo;</span>
                    </li>
                    <li v-on:click="goTo(page)" class="btn btn-info" v-for="page in pagination" v-bind:class="{'active': page == current, 'btn-fill': page == current}">
                        {{ page }}
                    </li>
                    <li v-on:click="goTo(next)" aria-label="Suivant" class="btn btn-info">
                        <span aria-hidden="true">&raquo;</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>

</template>


<script>

    export default {

        props: [
            'current',
            'last',
            'total',
        ],

        data: function() {
            return {
                first: 1,
                length: 8,
            }
        },
        computed: {
            min: function () {
                return Math.max(
                    Math.min(this.current - parseInt((this.length - 1) / 2), this.last - this.length + 1),
                    this.first
                )
            },
            max: function () {
                return Math.min(
                    Math.max(this.current + parseInt((this.length - 1) / 2), this.length),
                    this.last
                )
            },
            previous: function() {
                return this.current > 1 ? this.current - 1 : 1;
            },
            next: function() {
                return this.current < this.max ? this.current + 1 : this.max
            },
            pagination: function () {
                var links = new Array()
                for (var i = this.min; i <= this.max; ++i) {
                    if (i == this.min && i != this.first) {
                        links.push(this.first)
                    } else if (i == this.max && i != this.last) {
                        links.push(this.last)
                    } else {
                        links.push(i)
                    }
                }
                return links
            },
        },
        methods: {
            goTo: function (page) {
                if (page != this.current) {
                    this.current = page
                    this.$emit('pagination-changed')
                }
            }
        },
    }

</script>



<style scoped>

    .card .footer div {
        display: block;
    }

    .footer > div {
        margin: 10px;
    }

    .card .footer hr {
        margin-top: 0px;
    }

    ul {
        margin: 0px;
    }

    .btn a {
        color: inherit;
    }

</style>
