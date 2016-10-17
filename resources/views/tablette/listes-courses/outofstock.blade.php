@if (isset($produits) && count($produits) > 0)
	<div id="outOfStock" class="clearfix">
		<div class="clearfix">
			<div class="col-sm-8">
				<h2>{!!count($produits)!!} produits en rupture de stock : </h2>
			</div>
			<div id="links" class="col-sm-4 pull-right text-right">
				<a href="#" id="btn-check" class="hide">
					<span class="glyphicon glyphicon-check"></span>
				</a>
				<a href="#" id="btn-uncheck">
					<span class="glyphicon glyphicon-unchecked"></span>
				</a>
				<a href="#" id="show-outofstock">
					<span class="fa fa-eye-slash"></span>
				</a>
			</div>
		</div>

		<div id="outofstock_form" class="clearfix masqued">
			{!! Form::open(array('class' => 'form-horizontal', 'url' => 'listes-courses/addProducts')) !!}
				<ul id="outofstock-form">
					@foreach ($produits as $produit)
					<li class="col-sm-6">
						<div class="form-group">
							{!! Form::checkbox('produits[]', $produit->id, array('class' => 'form-control')) !!}
							{!! Form::label('produits', $produit->nom.' ('.$produit->quantite.(!is_null($produit->unite) ? ' '.$produit->unite : '').' en stock)', array('class' => 'control-label')) !!}
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
				$('#btn-check').addClass('hide');
				$('#btn-uncheck').removeClass('hide');
				return false;
			});

			$('#btn-uncheck').click(function(){
				$('#outofstock-form input').each(function(){
					$(this).attr('checked', false);
				});
				$('#btn-uncheck').addClass('hide');
				$('#btn-check').removeClass('hide');
				return false;
			});

			$('#show-outofstock').click(function() {
				$('#outofstock_form').toggle(500);
				if ($('#show-outofstock span').hasClass('fa-eye')) {
					$('#show-outofstock span').removeClass('fa-eye').addClass('fa-eye-slash')
				} else {
					$('#show-outofstock span').removeClass('fa-eye-slash').addClass('fa-eye')
				}
				return false;
			});
		});
	</script>
@endif
