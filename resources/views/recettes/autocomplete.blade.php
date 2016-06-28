<div id="autocomplete_form" class="clearfix">
	<div class="clearfix">
		<div class="form-group">
			{!! Form::label('produits', 'Saisir des premières lettres de l\'ingrédient', array('class' => 'col-md-6 control-label')) !!}
			<div class="col-md-6">
				{!! Form::text('produit', '', array('id' => 'autocomplete', 'class' => 'form-control')) !!}
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
    $(function() {
        $("#autocomplete").autocomplete({
            source: baseURL+"/getdata",
            minLength: 3,
            select: function( event, ui ) {
				// if(typeof(apiCallingPage) != undefined && apiCallingPage == true)
				// {
				// 	$('#liste-ingredients').val($('#liste-ingredients').val() + ' ' + ui.item.value);
				// }
				// else
				{
					// add product on liste des produits
					var existProduct = false;
					$('#liste_produits li').each(function() {
						if($(this).data('id') == ui.item.id) {
							existProduct = true;
						}
					});

					// @TODO : refactoring this !!!
					if(!existProduct) {
						$('#liste_produits').append('\
						<li id="ingredient_'+ui.item.id+'" data-id="'+ui.item.id+'">\
						<div class="clearfix">\
						<input type="hidden" name="produits[]" value="'+ui.item.id+'">\
						<input class="col-sm-2" type="text" name="quantite_'+ui.item.id+'">\
						<select class="col-sm-2" name="unite_'+ui.item.id+'">\
							<option value="">---</option>\
							<option value="grammes">Grammes</option>\
							<option value="litre">Litre</option>\
							<option value="centilitre">Centilitre</option>\
							<option value="cuillere_cafe">Cuillere à Cafe</option>\
							<option value="cuillere_dessert">Cuillere à Dessert</option>\
							<option value="cuillere_soupe">Cuillere à Soupe</option>\
							<option value="verre_liqueur">Verre à liqueur</option>\
							<option value="verre_moutarde">Verre à moutarde</option>\
							<option value="grand_verre">Grand verre</option>\
							<option value="tasse_cafe">Tasse à café</option>\
							<option value="bol">Bol</option>\
							<option value="sachet">Sachet</option>\
							<option value="gousse">Gousse</option>\
						</select>\
						<span class="col-sm-8">'+ui.item.value+'</span>\
						</div>\
						</li>');
					} else {
						alert('L\'ingrédient est déjà présent dans la recette.')
					}
				}
            }
        });
    });
</script>
