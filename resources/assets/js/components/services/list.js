
import {HTTP} from './http-common'

export const RestList = Vue.extend({

    abstract: true,

    data: function() {
        return {
            item: {},
            sortCol: 'id',
            sortDir: 'desc',
            searchDelayer: null,
        }
    },

    computed: {
        endpoint: function () {
            // return this.$route.path.split('/').slice(-1)[0]
            return this.$route.name
        },
        parentRoute: function () {
            return this.$route.path.split('/').slice(0, -1).join('/')
        },
    },

    methods: {
        fetchList() {
            HTTP.get(this.endpoint, querystring.stringify())
                .then(response => {
                    this.item = response.data
                })
                .catch(e => {
                    this.errors.push(e)
                })
        },
    },

})
