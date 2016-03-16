@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					@include('listes.autocomplete')
					@include('listes.outofstock')
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
							<a href="listes/export/pdf" class="btn btn-sm btn-success" target="_blank">
								<span class="glyphicon glyphicon-ok"></span> Exporter la liste en PDF
							</a>
							<a href="listes/export/trello" class="btn btn-sm btn-success">
								<span class="glyphicon glyphicon-ok"></span> Envoyer la liste sur carte Trello
							</a>
							<a href="listes/endingList" class="btn btn-sm btn-danger" onclick="return confirm('Cette action renouvellera le stock avec les produits de la liste de courses. En ëtes vous sûr?')">
								<span class="glyphicon glyphicon-ok"></span> Clore la liste de course
							</a>
						</div>
					</div>
					<div id="liste-courses-products">
						@include('listes.productslist')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



@endsection
