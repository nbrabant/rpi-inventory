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
						<a href="/recettes/add" class="btn btn-sm btn-success">
							<span class="glyphicon glyphicon-plus"></span> Ajouter
						</a>
					</div>
				</div>
				<div class="panel-body">
					@if (count($recettes) > 0)
						<table class="table">
							<thead>
								<tr>
									<th></th>
									<th>Nom</th>
									<th>Nb personnes</th>
									<th>Tps préparation</th>
									<th>Tps cuisson</th>
									<th class="actions">Actions</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($recettes as $recette)
									<tr>
										<td>{{ $recette->id }}</td>
										<td>{{ $recette->nom }}</td>
										<td>{{ $recette->nombre_personnes }}</td>
										<td>{{ $recette->temps_preparation }}</td>
										<td>{{ $recette->temps_cuisson }}</td>
										<td>
											<a href="/recettes/show/{{ $recette->id }}" class="btn btn-xs btn-primary">
												<span class="glyphicon glyphicon-eye-open"></span> Show
											</a>
											<a href="/recettes/edit/{{ $recette->id }}" class="btn btn-xs btn-info">
												<span class="glyphicon glyphicon-edit"></span> Editer
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<div class="alert alert-warning">Aucun résultat.</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
