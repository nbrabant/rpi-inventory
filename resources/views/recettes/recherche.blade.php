@extends('app')

@section('content')

<script type="text/javascript">
	var apiCallingPage = true;
</script>

<div id="admin-recette" class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<h1>{{ $title }}</h1>
					@include('recettes.autocomplete')
					<div class="clearfix">
						<legend>Liste des ingrédients</legend>
						{!! Form::text('ingredients', null, array('id' => 'liste-ingredients', 'class' => 'form-control')) !!}
						{!! Form::button('Rechercher', array('id' => 'search-recettes', 'class' => 'form-control btn btn-primary')) !!}
					</div>
				</div>
			</div>

			<div id="result-recette" class="clearfix">
				Liste des recettes

			</div>

		</div>
	</div>
</div>
@endsection
