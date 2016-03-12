<div id="autocomplete_form" class="clearfix">
	<h2>Rechercher un produit</h2>
	{!! Form::open(array('class' => 'form-horizontal', 'url' => 'listes/addProducts')) !!}
		<div class="form-group">
			{!! Form::label('produits', 'Saisir des premières lettres du produit', array('class' => 'col-md-6 control-label')) !!}
			<div class="col-md-6">
				{!! Form::text('produit', '', array('id' => 'autocomplete', 'class' => 'form-control')) !!}
			</div>
		</div>
<?= Form::label('response', 'Our color key: ') ?>
<?= Form::text('response', '', array('id' =>'response', 'disabled' => 'disabled')) ?>
	{!! Form::close() !!}
</div>

<script type="text/javascript">
    $(function() {
        $("#autocomplete").autocomplete({
            source: "getdata",
            minLength: 3,
            select: function( event, ui ) {
                $('#response').val(ui.item.id);
            }
        });
    });
</script>
