// Format date time
Vue.filter('date-time', function (value) {
    return moment(value).format('dddd Do MMMM YYYY à LT')
})

// Format date
Vue.filter('datetime', function (value) {
    return moment(value).format('L à LT')
})

// Format boolean value as icon
Vue.filter('bool-icon', function (value) {
    return parseInt(value) ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>'
})

// Format email as mailto link
Vue.filter('mailto', function (value) {
    return '<a href="mailto:' + value + '">' + value + '</a>'
})

// Format url as link
Vue.filter('route-link', function (value, full_link) {
    if(!full_link) {
        value = "/"+value;
    }
    return '<a href="' + value + '" target="_blank">' + value + '</a>'
})

// Format url as link for back office
Vue.filter('back-link', function (value, url, id) {
    var render = '<a href="/administration#/' + url;

    if(typeof id != "undefined")
        render += '/' + id;

    render += '">' + value + '</a>';
    return render;
})

// Format number as price
Vue.filter('price-euro', function (value) {
    return intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR',
    }).format(value)
})

// Format title
Vue.filter('user-title', function (value) {
    if (value === 'M') {
        return 'Monsieur'
    }
    if (value === 'Mme') {
        return 'Madame'
    }
    if (value === 'Mlle') {
        return 'Mademoiselle'
    }
    return value
})

// Truncate string to the given length (default : 50 characters)
Vue.filter('truncate', function (value, length) {
    if (length === undefined) {
        length = 50
    }
    if (typeof value !== 'string' || value.length <= length) {
        return value
    }
    return value.substring(0, length).trim() + '...'
})

Vue.filter('nl2br', function (value, isXhtml) {
    var breakTag = (isXhtml || typeof isXhtml === 'undefined') ? '<br ' + '/>' : '<br>'
    return (value + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2')
})

Vue.filter('fix-amount', function(value) {
    if(typeof(value) != 'number') {
        return value
    }
    return value.toFixed(2)
})

// Format import type
Vue.filter('str_slug_fr', function (str) {

    str = str.replace(new RegExp("'", 'g'), ' ');
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to   = "aaaaeeeeiiiioooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return str;
})

Vue.filter('type-operation', function(str) {
    if (str === '+') {
        return 'Ajout'
    } else if (str === '-') {
        return 'Retrait'
    }
    return str;
})
