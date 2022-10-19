import axios from 'axios';

export default Vue.extend({

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
            errors: {}
        }
    },

    computed: {
        parentRoute: function () {
            return this.$route.path.split('/').slice(0, -1).join('/') + '/'
        },
        HTTP: function() {
            return axios.create({
                baseURL: 'api/',
                headers: {
                    Authorization: 'Bearer {token}'
                }
            })
        }
    },

    methods: {
        toCamelCase: function(str) {
            return str.replace(/-/g, ' ').replace(/(?:^\w|[A-Z]|\b\w)/g, function(letter, index) {
                return index == 0 ? letter.toLowerCase() : letter.toUpperCase();
            }).replace(/\s+/g, '');
        },

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

        getRelatedResource: function(route, keyKey, valueKey, sortCol, sortDir, setVar) {
            var params = { fields: keyKey+','+valueKey, limit: 'full' }
            params.sortCol = sortCol ? sortCol : valueKey
            params.sortDir = sortDir ? sortDir : 'asc'

            if (!setVar) {
                var setVar = this.toCamelCase(route)
            }

            var options = []

            this.HTTP.get(route, querystring.stringify(params))
                .then(function(response) {
                    if (!response.data instanceof Object || !response.data.data instanceof Array) {
                        return
                    }

                    for (var key in response.data.data) {
                        options.push({
                            key: response.data.data[key][keyKey],
                            value: response.data.data[key][valueKey],
                        })
                    }
                }).catch(function(response) {
                    // console.log('catch',response)
                });

            Vue.set(this, setVar, options)
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
                    if (key == 'id') {
                        route += '/' + params[key]
                    } else {
                        // route += '{/' + key + '}'
                    }
                }
            }

            this.prepareRestGet(route, params, item)

            this.HTTP.get(route, {params: params})
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
                swal.fire({
                    title: this.statusTexts[response.status],
                    icon: 'error'
                });
            }
        },

        triggerRestSave: function (route, params, item) {
            this.prepareRestSave(route, params, item)
            this.HTTP.post(route, item, params)
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
                swal.fire({
                    title: this.statusTexts[response.status],
                    html: 'Erreur',
                    icon: 'error'
                });
            }
        },

        triggerRestUpdate: function (route, params, item) {
            for (var key in params) {
                if (params.hasOwnProperty(key) && key.charAt(0) != '_') {
                    route += '/' + params[key]
                }
            }

            this.prepareRestUpdate(route, params, item)
            this.beforeUpdate(params, item)
            this.HTTP.patch(route, item, params)
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
        beforeUpdate: function(params, item) {},
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
                swal.fire({
                    title: this.statusTexts[response.status],
                    html: 'Erreur',
                    icon: 'error'
                });
            }
        },

        confirmRestDelete: function (text, route, params) {
            var component = this;

            swal.fire("Êtes-vous sûr ?", {
                title: "Êtes-vous sûr ?",
                html: this.$options.filters.truncate(text, 70),
                icon: "warning",
                showConfirmButton: true,
                confirmButtonText: 'Oui, supprimer!',
                showCancelButton: true,
                confirmCancelText: 'Non'
            }).then((sweetAlertResult) => {
                if (!sweetAlertResult || !sweetAlertResult.isConfirmed) return;

                component.triggerRestDelete(route, params)
            });
        },
        triggerRestDelete: function (route, params) {
            this.prepareRestDelete(route, params)

            for (var key in params) {
                if (params.hasOwnProperty(key) && key.charAt(0) != '_') {
                    route += '/' + params[key]
                }
            }
            this.HTTP.delete(route, { data: params })
                .then(response => {
                    this.successRestDelete(response)
                }).catch(response => {
                    if (response.response) {
                        this.errorRestDelete(response.response)
                    } else {
                        this.errorRestDelete(response)
                    }
                });
        },
        prepareRestDelete: function (route, params) {
            this.cacheRestQuery('triggerRestDelete', route, params);
        },
        successRestDelete: function (response) {
            swal.fire({
                title: "Supprimé !",
                html: "L'enregistrement a correctement été supprimé.",
                icon: "success"
            }).then((value) => {
                // this.$router.go(this.parentRoute)
                location.reload()
            });
        },
        errorRestDelete: function(response) {
            if (response.status === 401) {
                this.requestRestAuthentication()
            } else {
                swal.fire({
                    title: this.statusTexts[response.status],
                    icon: 'error'
                });
            }
        },

    },

})
