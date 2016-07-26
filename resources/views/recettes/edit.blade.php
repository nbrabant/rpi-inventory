@extends('app')

@section('content')
<div id="admin-recette" class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">{{ $title }}</div>
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

					{!! Form::model($recette, array('class' => 'form-horizontal', 'url' => 'recettes/edit/'.$recette->id, 'files'=>true)) !!}
						<div class="form-group">
							{!! Form::label('nom', 'Nom', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::text('nom', null, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('visuel', 'Visuel', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::file('visuel') !!}
								<p class="help-block">Format de fichier autorisé : JPG / PNG</p>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('instructions', 'Instructions', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::textarea('instructions', null, array('class' => 'form-control ckeditor')) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('nombre_personnes', 'Nombre de personnes', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::text('nombre_personnes', null, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('temps_preparation', 'Temps de preparation', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::text('temps_preparation', null, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('temps_cuisson', 'Temps de cuisson', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::text('temps_cuisson', null, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="clearfix">
							<legend>Liste des ingrédients</legend>
							@if (!is_null($recette->complement))
								<div class="alert alert-warning">
									<strong>
										Certains ingrédients de la recettes n'ont pas été renseignés. Ceux-ci ne pourrons pas être mis à jour dans la liste de course :
									</strong>
									<br />
									{{ $recette->complement }}
								</div>
							@endif

							@include('recettes.autocomplete')
							<ul id="liste_produits">
								@if (count($recette->produits) > 0)
									@foreach ($recette->produits as $produit)
										<li id="ingredient_{{ $produit->id }}" data-id="{{ $produit->produit_id }}">
											<div class="clearfix">
												<a class="col-sm-2 btn btn-xs btn-sm btn-danger delete_product">supprimer</a>
												<input type="hidden" name="produits[]" value="{{ $produit->produit_id }}">
												<input class="col-sm-2" type="text" name="quantite_{{ $produit->produit_id }}" value="{{ $produit->quantite }}">
												{!! Form::select('unite_'.$produit->produit_id, $uniteList, $produit->unite, array('class' => 'col-sm-2')) !!}
												<span class="col-sm-6">{{ $produit->produit->nom }}</span>
											</div>
										</li>
									@endforeach
								@endif
							</ul>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								{!! Form::submit('Enregistrer', array('class' => 'btn btn-primary')) !!}
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
