<div id="autocomplete_form" class="clearfix">
	<h2>Rechercher un produit</h2>
	<div class="clearfix">
		{!! Form::open(array('class' => 'col-sm-8 form-horizontal', 'url' => 'consomation/productDetails')) !!}
		<div class="form-group">
			{!! Form::label('produits', 'Saisir des premières lettres du produit', array('class' => 'col-md-6 control-label')) !!}
			<div class="col-md-6">
				{!! Form::text('produit', '', array('id' => 'autocomplete', 'class' => 'form-control autocomplete-keyboard')) !!}
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>

<script type="text/javascript">
    $(function() {
        $("#autocomplete").autocomplete({
            source: "getdata",
            minLength: 3,
            select: function( event, ui ) {
				$.ajax({
					type: "POST",
					url: baseURL+"/consomation/productDetails/"+ui.item.id,
					async: true,
					data: {
						produit: [ui.item.id],
					},
					success: function(data) {
						if (typeof(data) == 'object' && typeof(data.status) == 'boolean') {
							$('#products-details').html(data.html);
						} else {
							alert('Erreur retour: ');
						}
					}
				})
            }
        });
    });
</script>
