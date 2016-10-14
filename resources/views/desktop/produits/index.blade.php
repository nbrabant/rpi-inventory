@extends('desktop.app')

@section('content')

<div class="col-md-12">

	@if (count($categories) > 0)
		@foreach ($categories as $categorie)
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th colspan="4">{{$categorie->nom}}</th>
					</tr>
					<tr>
						<th></th>
						<th>Nom</th>
						<th>Etat du stock</th>
						<th class="actions">Actions</th>
					</tr>
				</thead>
				<tbody>
					@if (count($categorie->produits) > 0)
						@foreach ($categorie->produits as $produit)
							<tr>
								<td>{{ $produit->id }}</td>
								<td>{{ $produit->nom }}</td>
								<td class="{{ $produit->getStatus() }}">{{ $produit->quantite }}</td>
								<td>
									<a href="/produits/show/{{ $produit->id }}" class="btn btn-xs btn-primary">
										<span class="glyphicon glyphicon-eye-open"></span> Voir les opérations sur le produits
									</a>
									<a href="/produits/edit/{{ $produit->id }}" class="btn btn-xs btn-info">
										<span class="glyphicon glyphicon-edit"></span> Editer
									</a>
									<a href="/produits/addToCart/{{ $produit->id }}" class="btn btn-xs btn-success">
										<span class="glyphicon glyphicon-edit"></span> Ajouter à la liste courante
									</a>
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4"><div class="alert alert-warning">Aucun résultat.</div></td>
						</tr>
					@endif
				</tbody>
			</table>
			<br />
		@endforeach
	@else
		<div class="alert alert-warning">Aucun résultat.</div>
	@endif

</div>
@endsection
