@extends('tablette.app')

@section('content')

<div class="col-md-12">
	@if (count($recettes) > 0)
		<table class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
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
						<td>
							<a href="/recettes/show/{{ $recette->id }}" class="full_size_link">
								<div>{{ $recette->nom }}</div>
							</a>
						</td>
						<td>
							<a href="/recettes/show/{{ $recette->id }}" class="full_size_link">
								<div>{{ $recette->nombre_personnes }}</div>
							</a>
						</td>
						<td>
							<a href="/recettes/show/{{ $recette->id }}" class="full_size_link">
								<div>{{ $recette->temps_preparation }}</div>
							</a>
						</td>
						<td>
							<a href="/recettes/show/{{ $recette->id }}" class="full_size_link">
								<div>{{ $recette->temps_cuisson }}</div>
							</a>
						</td>
						<td>
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


@endsection
