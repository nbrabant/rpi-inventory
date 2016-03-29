function json_encode(a) {var b,c=this.window.JSON;try{if(typeof c==="object"&&typeof c.stringify==="function"){b=c.stringify(a);if(b===undefined){throw new SyntaxError("json_encode")}return b}var d=a;var e=function(a){var b=/[\\\"\u0000-\u001f\u007f-\u009f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g;var c={"\b":"\\b","	":"\\t","\n":"\\n","\f":"\\f","\r":"\\r",'"':'\\"',"\\":"\\\\"};b.lastIndex=0;return b.test(a)?'"'+a.replace(b,function(a){var b=c[a];return typeof b==="string"?b:"\\u"+("0000"+a.charCodeAt(0).toString(16)).slice(-4)})+'"':'"'+a+'"'};var f=function(a,b){var c="";var d="    ";var g=0;var h="";var i="";var j=0;var k=c;var l=[];var m=b[a];if(m&&typeof m==="object"&&typeof m.toJSON==="function"){m=m.toJSON(a)}switch(typeof m){case"string":return e(m);case"number":return isFinite(m)?String(m):"null";case"boolean":case"null":return String(m);case"object":if(!m){return"null"}if(this.PHPJS_Resource&&m instanceof this.PHPJS_Resource||window.PHPJS_Resource&&m instanceof window.PHPJS_Resource){throw new SyntaxError("json_encode")}c+=d;l=[];if(Object.prototype.toString.apply(m)==="[object Array]"){j=m.length;for(g=0;g<j;g+=1){l[g]=f(g,m)||"null"}i=l.length===0?"[]":c?"[\n"+c+l.join(",\n"+c)+"\n"+k+"]":"["+l.join(",")+"]";c=k;return i}for(h in m){if(Object.hasOwnProperty.call(m,h)){i=f(h,m);if(i){l.push(e(h)+(c?": ":":")+i)}}}i=l.length===0?"{}":c?"{\n"+c+l.join(",\n"+c)+"\n"+k+"}":"{"+l.join(",")+"}";c=k;return i;case"undefined":case"function":default:throw new SyntaxError("json_encode")}};return f("",{"":d})}catch(g){if(!(g instanceof SyntaxError)){throw new Error("Unexpected error type in json_encode()")}this.php_js=this.php_js||{};this.php_js.last_error_json=4;return null}}

var updatePos = function(e) {
	var list = e.length ? e : $(e.target);
	$.ajax({
		type:  "POST",
		url:   "/sortlist",
		async: true,
		cache: false,
		dataType: "json",
		data: {positions: json_encode( list.sortable('serialize') )},
		beforeSend: function() {
			$('#feedback').html('<div class="alert alert-warning">Mise à jour en cours</div>');
		},
		success: function(data, textStatus, jqXHR) {
			if (data.status != true) {
				$('#feedback').html('<div class="alert alert-danger">Une erreur s\'est produite lors de la mise à jour des informations</div>');
			} else {
				$('#feedback').html('<div class="alert alert-success">Mise à jour effectuée avec succès</div>');
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
			$('#feedback').html('<div class="alert alert-danger">Une erreur s\'est produite lors de la mise à jour des informations</div>');
		}
	});
}

$(function() {
	$( "#sortable" ).sortable({
		placeholder: "ui-state-highlight",
		update: updatePos
	})
	.disableSelection();
});
