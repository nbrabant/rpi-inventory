@extends('tablette.app')

@section('content')

<script type="text/javascript">
	var apiCallingPage = true;
</script>

<div id="admin-recette" class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			<div class="clearfix">
				<legend>Saisir le nom de la recette ou une liste d'ingrédients</legend>
				{!! Form::text('ingredients', null, array('id' => 'liste-ingredients', 'class' => 'form-control')) !!}
				{!! Form::button('Rechercher', array('id' => 'search-recettes', 'class' => 'form-control btn btn-primary')) !!}
			</div>
		</div>
	</div>

	<div id="result-recette" class="clearfix">
		Liste des recettes
	</div>

</div>

@endsection
