@extends('app')

@section('content')

<div id="admin-recette" class="col-md-12">

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
			{!! Form::label('nom', 'Nom', array('class' => 'col-md-3 control-label')) !!}
			<div class="col-md-9">
				{!! Form::text('nom', null, array('class' => 'form-control')) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('visuel', 'Visuel', array('class' => 'col-md-3 control-label')) !!}
			<div class="col-md-9">
				{!! Form::file('visuel') !!}
				<p class="help-block">
					Format de fichier autorisé : JPG / PNG
				</p>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('instructions', 'Instructions', array('class' => 'col-md-3 control-label')) !!}
			<div class="col-md-9">
				{!! Form::textarea('instructions', null, array('class' => 'form-control ckeditor')) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('nombre_personnes', 'Nombre de personnes', array('class' => 'col-md-3 control-label')) !!}
			<div class="col-md-9">
				{!! Form::text('nombre_personnes', null, array('class' => 'form-control')) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('temps_preparation', 'Temps de preparation', array('class' => 'col-md-3 control-label')) !!}
			<div class="col-md-9">
				{!! Form::text('temps_preparation', null, array('class' => 'form-control')) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('temps_cuisson', 'Temps de cuisson', array('class' => 'col-md-3 control-label')) !!}
			<div class="col-md-9">
				{!! Form::text('temps_cuisson', null, array('class' => 'form-control')) !!}
			</div>
		</div>

		<div class="clearfix">
			<legend>Liste des ingrédients</legend>
			@include('recettes.autocomplete')
			<ul id="liste_produits"></ul>
		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<a href="{{ url().'/recettes' }}" class="btn btn-default">
					Retour
				</a>
				{!! Form::submit('Enregistrer', array('class' => 'btn btn-primary')) !!}
			</div>
		</div>
	{!! Form::close() !!}

</div>

@endsection
