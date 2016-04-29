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
