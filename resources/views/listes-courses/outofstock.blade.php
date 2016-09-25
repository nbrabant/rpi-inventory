@if (isset($produits) && count($produits) > 0)
	<div id="outOfStock" class="clearfix">
		<div class="clearfix">
			<div class="col-sm-8">
				<h2>{!!count($produits)!!} produits en rupture de stock : </h2>
			</div>
			<div class="col-sm-4">
				<a href="#" id="show-outofstock" class="btn btn-sm btn-default pull-right">Voir la liste</a>
			</div>
		</div>

		<div id="outofstock_form" class="clearfix masqued">
			<div class="clearfix">
				<div class="col-sm-4">
					<a href="#" id="btn-check" class="btn btn-sm btn-success">
						<span class="glyphicon glyphicon-check"></span> Tout cocher
					</a>
					<a href="#" id="btn-uncheck" class="btn btn-sm btn-success">
						<span class="glyphicon glyphicon-unchecked"></span> Tout décocher
					</a>
				</div>
			</div>

			{!! Form::open(array('class' => 'form-horizontal', 'url' => 'listes-courses/addProducts')) !!}
				<ul id="outofstock-form">
					@foreach ($produits as $produit)
					<li class="col-sm-6">
						<div class="form-group">
							<div class="col-md-1">
								{!! Form::checkbox('produits[]', $produit->id, array('class' => 'form-control')) !!}
							</div>
							{!! Form::label('produits', $produit->nom.' ('.$produit->quantite.(!is_null($produit->unite) ? ' '.$produit->unite : '').' en stock)', array('class' => 'col-md-11 control-label')) !!}
						</div>
					</li>
					@endforeach
				</ul>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						{!! Form::submit('Ajouter à la liste de courses', array('class' => 'btn btn-primary')) !!}
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btn-check').click(function(){
				$('#outofstock-form input').each(function(){
					if(!$(this).is(':checked')) {
						$(this).click();
					}
				});
				return false;
			});

			$('#btn-uncheck').click(function(){
				$('#outofstock-form input').each(function(){
					$(this).attr('checked', false);
				});
				return false;
			});

			$('#show-outofstock').click(function() {
				$('#outofstock_form').toggle(500);
				return false;
			});
		});
	</script>
@endif
