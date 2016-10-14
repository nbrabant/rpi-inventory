@extends('tablette.app')

@section('content')

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading clearfix">
			@include('tablette.listes-courses.autocomplete')
			@include('tablette.listes-courses.outofstock')
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
				<div class="col-md-12">
					<h3>Liste de courses</h3>
				</div>
				<div class="col-md-12 pull-right">
					<a href="listes-courses/export/pdf" class="btn btn-sm btn-success" target="_blank">
						<span class="glyphicon glyphicon-ok"></span> Exporter la liste en PDF
					</a>
					<a href="listes-courses/export/trello" class="btn btn-sm btn-success">
						<span class="glyphicon glyphicon-ok"></span> Envoyer la liste sur carte Trello
					</a>
					<a href="listes-courses/endingList" class="btn btn-sm btn-danger" onclick="return confirm('Cette action renouvellera le stock avec les produits de la liste de courses. En ëtes vous sûr?')">
						<span class="glyphicon glyphicon-ok"></span> Clore la liste de course
					</a>
				</div>
			</div>
			<div id="liste-courses-products">
				@include('tablette.listes-courses.productslist')
			</div>
		</div>
	</div>
</div>

@endsection
