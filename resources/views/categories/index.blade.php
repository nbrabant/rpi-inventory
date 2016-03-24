@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<div class="col-md-10">
						{{ $title }}
					</div>
					<div class="col-md-2">
						<a href="/categories/add" class="btn btn-sm btn-success">
							<span class="glyphicon glyphicon-plus"></span> Ajouter
						</a>
					</div>
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

					@if (count($categories) > 0)
						<div id="feedback"></div>
						<ul id="sortable">
							@foreach ($categories as $categorie)
								<li id="{{$categorie->id}}" class="ui-state-default clearfix">
									<div class="col-sm-1">
										<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
									</div>
									<div class="col-sm-7">
										{{ $categorie->nom }}
									</div>
									<div class="col-sm-4">
										<a href="/categories/show/{{ $categorie->id }}" class="btn btn-sm btn-primary">
											<span class="glyphicon glyphicon-eye-open"></span> Voir les produits
										</a>
										<a href="/categories/edit/{{ $categorie->id }}" class="btn btn-sm btn-info">
											<span class="glyphicon glyphicon-edit"></span> Editer
										</a>
									</div>
								</li>
							@endforeach
						</ul>
					@else
						<div class="alert alert-warning">Aucun résultat.</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
