import RestCore from './restcore';

export default RestCore.extend({
	data: function() {
        return {
            item: {},
            links: [],
            sortCol: 'id',
            sortDir: 'desc',
            searchDelayer: null,
        }
    },

    mounted: function() {
        if (this.endpoint == undefined) return

        this.triggerRestGet(this.endpoint)
    },

    computed: {
        newurl: function () {
            return { path: '/' + this.endpoint + '/create' }
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

        pagination: function(page) {
            this.item.current_page = page;
            this.triggerRestGet(this.endpoint, {'page' : page}, this.item)
        }
    },

    // declare in created
    events: {
        'sort-changed': function () {
            this.triggerRestGet(this.endpoint)
        },
    }
})