$(document).ready(function() {
	$('#search-recettes').click(function() {
		ingredients = $('#liste-ingredients').val();

		if(typeof(ingredients) == undefined || ingredients.length <= 0) {
			alert('Votre recherche doit comporter au moins une ingrédient.')
			return false;
		}

		$.ajax({
			type:  "POST",
			url:   "/recettes/apisearch",
			async: true,
			cache: false,
			dataType: "json",
			data: {ingredients: ingredients},
			beforeSend: function() {
				$('#result-recette').html('<div class="alert alert-warning">Recherche en cours</div>');
			},
			success: function(data, textStatus, jqXHR) {
				if (data.status != true) {
					$('#result-recette').html('<div class="alert alert-danger">Une erreur s\'est produite lors de la mise à jour des informations</div>');
				} else {
					$('#result-recette').html(data.html);
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				$('#result-recette').html('<div class="alert alert-danger">Une erreur s\'est produite lors de la mise à jour des informations</div>');
			}
		});
	});

});

$(document).on('click', '.populate-recipe', function() {
	$.ajax({
		type:  "POST",
		url:   "/recettes/apipopulate",
		async: true,
		cache: false,
		dataType: "json",
		data: {url: $(this).data('url')},
		beforeSend: function() {
			$('#result-recette').html('<div class="alert alert-warning">Recherche en cours</div>');
		},
		success: function(data, textStatus, jqXHR) {
			if (data.status != true) {
				$('#result-recette').html('<div class="alert alert-danger">Une erreur s\'est produite lors de la mise à jour des informations</div>');
			} else {
				$('#result-recette').html(data.html);
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
			$('#result-recette').html('<div class="alert alert-danger">Une erreur s\'est produite lors de la mise à jour des informations</div>');
		}
	});
});

$(document).on('click', '#sumbitRecette', function() {

	// here! complete submitted  repice
	// http://stackoverflow.com/questions/8151267/jquery-how-can-i-select-a-hidden-field

	var datas = {
		ajax 				: true,
		nom					: $('#nom').val(),
		imgurl				: $('#imgurl').val(),
		instructions		: $('#instructions').val(),
		nombre_personnes	: $('#nombre_personnes').val(),
		temps_preparation	: $('#temps_preparation').val(),
		temps_cuisson		: $('#temps_cuisson').val(),
		complement			: $('#complement').val()
	};

	// produits[]
	// quantite_'.$produit->produit_id
	// unite_'.$produit->produit_id

	$.ajax({
		type:  "POST",
		url:   "/recettes/add",
		async: true,
		cache: false,
		dataType: "json",
		data: datas,
		beforeSend: function() {
			$('#result-recette').html('<div class="alert alert-warning">Recherche en cours</div>');
		},
		success: function(data, textStatus, jqXHR) {
			if (data.status != true) {
				$('#result-recette').html('<div class="alert alert-danger">Une erreur s\'est produite lors de la mise à jour des informations</div>');
			} else {
				window.location.href = baseURL + "/recettes";
			}
		},
		error: function(jqXHR, textStatus, errorThrown) {
			$('#result-recette').html('<div class="alert alert-danger">Une erreur s\'est produite lors de la mise à jour des informations</div>');
		}
	});

	return false;
});
