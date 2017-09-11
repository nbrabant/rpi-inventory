
import {HTTP} from './http-common'
import {RestCore} from './core'

export const RestList = RestCore.extend({

    abstract: true,

    data: function() {
        return {
            item: {},
            sortCol: 'id',
            sortDir: 'desc',
            searchDelayer: null,
        }
    },

    mounted: function() {
        this.triggerRestGet(this.endpoint)
    },

    computed: {
        newurl: function () {
            return { name: this.singularName, params: {id: 'create'} }
        },
        endpoint: function () {
            return this.$route.path.split('/').slice(-2)[0]
        },
    },

    methods: {
        prepareRestGet: function (route, params, item) {
            if (this.item.current_page) {
                item.page = this.item.current_page
            }
            if (this.sortCol && this.sortDir) {
                item.sortCol = this.sortCol
                item.sortDir = this.sortDir
            }
            if (this.search) {
                item.search = this.search
                for (field in item.search) {
                    if (item.search[field].options !== undefined) {
                        delete(item.search[field].options)
                    }
                }
            }
            this.cacheRestQuery('triggerRestGet', route, params, item);
        },
    },

    events: {
        'sort-changed': function () {
            this.triggerRestGet(this.endpoint)
        },
        'pagination-changed': function () {
            this.triggerRestGet(this.endpoint)
        },
    },

})
