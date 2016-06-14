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

					if(!existProduct) {
						$('#liste_produits').append('\
						<li id="ingredient_'+ui.item.id+'" data-id="'+ui.item.id+'">\
						<div class="clearfix">\
						<input type="hidden" name="produits[]" value="'+ui.item.id+'">\
						<input class="col-sm-2" type="text" name="quantite_'+ui.item.id+'">\
						<span class="col-sm-10">'+ui.item.value+'</span>\
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
