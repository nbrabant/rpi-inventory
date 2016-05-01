<div id="admin-recette" class="container-fluid">
	<div class="row">
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

				{!! Form::open(array('class' => 'form-horizontal', 'url' => 'recettes/add', 'files'=>true)) !!}
					<div class="form-group">
						{!! Form::label('nom', 'Nom', array('class' => 'col-md-4 control-label')) !!}
						<div class="col-md-6">
							{!! Form::text('nom', (isset($recipe) ? $recipe['nom'] : null), array('class' => 'form-control')) !!}
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('visuel', 'Visuel', array('class' => 'col-md-4 control-label')) !!}
						<div class="col-md-6">
							{!! Form::file('visuel') !!}
							<p class="help-block">
								Format de fichier autorisé : JPG / PNG
								@if (isset($recipe))
									<br/>
									<span class="bold">Url de l'image de la recette : </span>
									<a href="{{ $recipe['imgurl'] }}" target="_blank">
										<img src="{{ $recipe['imgurl'] }}" alt="cliquer pour voir"/>
									</a>
								@endif
							</p>
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('instructions', 'Instructions', array('class' => 'col-md-4 control-label')) !!}
						<div class="col-md-6">
							{!! Form::textarea('instructions', (isset($recipe) ? $recipe['instructions'] : null), array('class' => 'form-control ckeditor')) !!}
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('nombre_personnes', 'Nombre de personnes', array('class' => 'col-md-4 control-label')) !!}
						<div class="col-md-6">
							{!! Form::text('nombre_personnes', (isset($recipe) ? $recipe['nombre_personnes'] : null), array('class' => 'form-control')) !!}
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('temps_preparation', 'Temps de preparation', array('class' => 'col-md-4 control-label')) !!}
						<div class="col-md-6">
							{!! Form::text('temps_preparation', (isset($recipe) ? $recipe['temps_preparation'] : null), array('class' => 'form-control')) !!}
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('temps_cuisson', 'Temps de cuisson', array('class' => 'col-md-4 control-label')) !!}
						<div class="col-md-6">
							{!! Form::text('temps_cuisson', (isset($recipe) ? $recipe['temps_cuisson'] : null), array('class' => 'form-control')) !!}
						</div>
					</div>

					<div class="clearfix">
						<legend>Liste des ingrédients</legend>
						@include('recettes.autocomplete')
						<ul id="liste_produits"></ul>
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
