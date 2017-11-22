
import {HTTP} from './http-common'

export const RestCore = Vue.extend({

    abstract: true,

    data: function() {
        return {
            statusTexts: {
                400: 'Requête incorrecte',
                401: 'Accès non autorisé',
                402: 'Paiement requis',
                403: 'Forbidden',
                404: 'Ressource introuvable',
                405: 'Action non implémentée',
                406: 'Not Acceptable',
                407: 'Proxy Authentication Required',
                408: 'Request Timeout',
                409: 'Conflict',
                410: 'Gone',
                411: 'Length Required',
                412: 'Precondition Failed',
                413: 'Request Entity Too Large',
                414: 'Request-URI Too Long',
                415: 'Unsupported Media Type',
                416: 'Requested Range Not Satisfiable',
                417: 'Expectation Failed',
                418: 'I\'m a teapot',                                               // RFC2324
                422: 'Erreurs de validation',                                       // RFC4918
                423: 'Locked',                                                      // RFC4918
                424: 'Failed Dependency',                                           // RFC4918
                425: 'Reserved for WebDAV advanced collections expired proposal',   // RFC2817
                426: 'Upgrade Required',                                            // RFC2817
                428: 'Precondition Required',                                       // RFC6585
                429: 'Too Many Requests',                                           // RFC6585
                431: 'Request Header Fields Too Large',                             // RFC6585
                500: 'Internal Server Error',
                501: 'Not Implemented',
                502: 'Bad Gateway',
                503: 'Service Unavailable',
                504: 'Gateway Timeout',
                505: 'HTTP Version Not Supported',
                506: 'Variant Also Negotiates (Experimental)',                      // RFC2295
                507: 'Insufficient Storage',                                        // RFC4918
                508: 'Loop Detected',                                               // RFC5842
                510: 'Not Extended',                                                // RFC2774
                511: 'Network Authentication Required',                             // RFC6585
                520: 'Unknow error',
                555: 'Ressource non supprimable',
            },
            restState: null,
        }
    },

    computed: {
        parentRoute: function () {
            return this.$route.path.split('/').slice(0, -1).join('/') + '/'
        },
    },

    watch: {
        item: function () {
            this.$emit('set-breadcrumbs', [])
        },
    },

    methods: {

        cacheRestQuery: function(method, route, params, item) {
            this.cached_method = method
            this.cached_route = route
            this.cached_params = params
            this.cached_item = item
        },

        retryRestQuery: function() {
            var method  = this.cached_method
            var route   = this.cached_route
            var params  = this.cached_params
            var item    = this.cached_item

            this[method](route, params, item)
        },

        getResource: function(route, params, item) {
            for (var key in params) {
                if (params.hasOwnProperty(key) && key.charAt(0) != '_') {
                    route += '/' + params[key]
                }
            }
            return HTTP.get(route, querystring.stringify(params))
        },

        setErrors: function(errors) {
            for (var key in errors) {
                if (errors.hasOwnProperty(key)) {
                    var textKey = key.replace(/\.([0-9])+\./g, "[$1].").replace(/\.([0-9])+/g, "[$1]");
                    Vue.set(this.errors, textKey, errors[key][0])
                }
            }
        },

        triggerRestGet: function (route, params, item) {
            $('.content').css('opacity', 0.25)
            if (item === undefined) {
                item = {}
            }
            for (var key in params) {
                if (params.hasOwnProperty(key) && key.charAt(0) != '_') {
                    route += '/' + params[key]
                }
            }
            this.prepareRestGet(route, params, item)
            HTTP.get(route, querystring.stringify(params))
                .then(response => {
                    this.successRestGet(response)
                })
                .catch(response => {
                    this.errorRestGet(response)
                });
        },
        successRestGet: function (response) {
            $('.content').css('opacity', 1)
            if (response.data instanceof Array && response.data.length === 0) {
                response.data = {}
            }
            this.item = response.data
        },
        errorRestGet: function(response) {
            $('.content').css('opacity', 1)
            if (response.status === 401) {
                this.requestRestAuthentication()
            } else {
                swal(this.statusTexts[response.status], null, 'error')
            }
        },

        triggerRestSave: function (route, params, item) {
            this.prepareRestSave(route, params, item)
            HTTP.post(route, item, params)
                .then(response => {
                    this.successRestSave(response)
                }).catch(response => {
                    if (response.response) {
                        this.errorRestSave(response.response)
                    } else {
                        this.errorRestSave(response)
                    }
                });
        },
        prepareRestSave: function (route, params, item) {
            this.cacheRestQuery('triggerRestSave', route, params, item);
            this.errors = {}
            this.restState = 'process'
        },
        successRestSave: function (response) {
            this.item = response.data;
            this.restState = 'success'
        },
        errorRestSave: function(response) {
            this.restState = 'error'
            if (response.status === 422) {
                this.setErrors(response.data.errors)
            } else if (response.status === 401) {
                this.requestRestAuthentication()
            } else {
                swal(this.statusTexts[response.status], 'Erreur', 'error')
            }
        },

        triggerRestUpdate: function (route, params, item) {
            for (var key in params) {
                if (params.hasOwnProperty(key) && key.charAt(0) != '_') {
                    route += '/' + params[key]
                }
            }

            this.prepareRestUpdate(route, params, item)
            HTTP.put(route, item, params)
                .then(response => {
                    this.successRestUpdate(response)
                }).catch(response => {
                    if (response.response) {
                        this.errorRestUpdate(response.response)
                    } else {
                        this.errorRestUpdate(response)
                    }
                });
        },
        prepareRestUpdate: function (route, params, item) {
            this.cacheRestQuery('triggerRestUpdate', route, params, item);
            this.errors = {}
            this.restState = 'process'
        },
        successRestUpdate: function (response) {
            this.item = response.data;
            this.restState = 'success'
        },
        errorRestUpdate: function(response) {
            this.restState = 'error'
            if (response.status === 422) {
                this.setErrors(response.data.errors)
            } else if (response.status === 401) {
                this.requestRestAuthentication()
            } else {
                swal(this.statusTexts[response.status], 'Erreur', 'error')
            }
        },

        confirmRestDelete: function (text, route, params) {
            var component = this
            swal({
                title: "Êtes-vous sûr ?",
                text: this.$options.filters.truncate(text, 70),
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oui, supprimer !",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function() {
                component.triggerRestDelete(route, params)
            });
        },
        triggerRestDelete: function (route, params) {
            this.prepareRestDelete(route, params)
            this.getResource(route, params)
                .delete()
                .then(response => {
                    this.successRestDelete(response)
                }).catch(response => {
console.log('error delete request', response)
                    this.errorRestDelete(response)
                });
        },
        prepareRestDelete: function (route, params) {
            this.cacheRestQuery('triggerRestDelete', route, params);
        },
        successRestDelete: function (response) {
            swal("Supprimé !", "L'enregistrement a correctement été supprimé.", "success");
            this.$router.go(this.parentRoute)
        },
        errorRestDelete: function(response) {
            if (response.status === 401) {
                this.requestRestAuthentication()
            } else {
                swal(this.statusTexts[response.status], null, 'error')
            }
        },

    },

})
