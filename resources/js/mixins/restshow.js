import RestCore from './restcore';

export default RestCore.extend({

	data: function() {
        return {
            item: {},
            errors: {},
        }
    },

    computed: {
        endpoint: function () {
            return this.$route.path.split('/').slice(-2, -1)[0]
        },
        submitText: function () {
            return this.item.id ? 'Enregistrer' : 'Ajouter'
        },
        submitIcon: function () {
            return {
                'fa': this.restState === undefined || this.restState !== null,
                'fa-circle-o-notch': this.restState === 'process',
                'fa-spin': this.restState === 'process',
                'fa-check': this.restState === 'success',
                'fa-exclamation': this.restState === 'error',
            }
        },
        submitBtn: function () {
            return {
                'btn': true,
                'btn-fill': true,
                'btn-primary': this.restState === undefined || this.restState === null,
                'btn-info': this.restState === 'process',
                'btn-success': this.restState === 'success',
                'btn-danger': this.restState === 'error',
            }
        },
    },

    mounted: function() {
        if (this.endpoint === undefined) return;

        this.triggerRestGet(this.endpoint, {id: this.$route.params.id}, this.item);
    },

    methods: {
        submitForm: function () {
            if (this.item.id) {
                this.triggerRestUpdate(this.endpoint, {id: this.item.id}, this.item)
            } else {
                this.triggerRestSave(this.endpoint, {}, this.item)
            }
        },

        prepareRestGet: function (route, item, params) {
            this.cacheRestQuery('triggerRestGet', route, params, item);
        },
    },

    events: {
        'confirm-delete': function () {
            this.confirmRestDelete(
                "Vous allez définitivement supprimer l'enregistrement " + this.title + '.',
                this.endpoint,
                {id: this.item.id}
            )
        },
    }

})