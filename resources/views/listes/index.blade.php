@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					@if (count($produits) > 0)
						<div id="outOfStock" class="clearfix">
							<div class="clearfix">
								<div class="col-sm-8">
									<h2>En rupture de stock</h2>
								</div>
								<div class="col-sm-4">
									<a href="#" id="btn-check" class="btn btn-sm btn-success">
										<span class="glyphicon glyphicon-check"></span> Tout cocher
									</a>
									<a href="#" id="btn-uncheck" class="btn btn-sm btn-success">
										<span class="glyphicon glyphicon-unchecked"></span> Tout décocher
									</a>
								</div>
							</div>
@todo : recherche autocomplétion produit
							{!! Form::open(array('class' => 'form-horizontal', 'url' => 'listes/addProducts')) !!}
								<ul id="outofstock-form">
									@foreach ($produits as $produit)
										<li class="col-sm-6">
											<div class="form-group">
												<div class="col-md-1">
													{!! Form::checkbox('produits[]', $produit->id, array('class' => 'form-control')) !!}
												</div>
												{!! Form::label('produits', $produit->nom.' ('.$produit->quantite.' en stock)', array('class' => 'col-md-11 control-label')) !!}
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
					@endif
				</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<div id="liste-courses" class="clearfix">
						<div class="col-md-9">
							<h3>Liste de courses</h3>
						</div>
						<div class="col-md-3">
							<a href="listes/endingList" class="btn btn-sm btn-danger" onclick="return confirm('Cette action renouvellera le stock avec les produits de la liste de courses. En ëtes vous sûr?')">
								<span class="glyphicon glyphicon-ok"></span> Clore la liste de course
							</a>
						</div>
					</div>
					@if (count($liste->lignesproduits) > 0)
@Todo : bouton export, bouton envoi mail, changement de quantite
						<table class="table">
							<thead>
								<th>
									<th>Nom</th>
									<th>Quantite</th>
									<th class="actions">Actions</th>
								</th>
							</thead>
							<tbody>
								@foreach ($liste->lignesproduits as $ligneProduit)
									<tr>
										<td></td>
										<td>{{ $ligneProduit->produit->nom }}</td>
										<td>{{ $ligneProduit->quantite }}</td>
										<td>
											<a href="/listes/delProducts/{{ $ligneProduit->id }}" class="btn btn-sm btn-danger">
												<span class="glyphicon glyphicon-close"></span> Supprimer de la liste
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<div class="alert alert-warning">Aucun produit dans la liste de course actuellement.</div>
					@endif
				</div>
			</div>
		</div>
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
	});
</script>

@endsection