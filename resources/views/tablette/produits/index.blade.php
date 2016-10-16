@extends('tablette.app')

@section('content')

<div class="col-md-12">

	@if (count($categories) > 0)
		@foreach ($categories as $categorie)
			<table class="table table-bordered table-hover table-striped categorie_produits">
				<thead>
					<tr>
						<th colspan="3">{{$categorie->nom}}</th>
					</tr>
					<tr>
						<th>Nom</th>
						<th>Etat du stock</th>
						<th class="actions">Actions</th>
					</tr>
				</thead>
				<tbody>
					@if (count($categorie->produits) > 0)
						@foreach ($categorie->produits as $produit)
							<tr>
								<td class="nom">
									<a href="/produits/show/{{ $produit->id }}" class="full_size_link">
										<div>{{ $produit->nom }}</div>
									</a>
								</td>
								<td class="stock {{ $produit->getStatus() }}">
									<a href="/produits/show/{{ $produit->id }}" class="full_size_link">
										<div>{{ $produit->quantite }}</div>
									</a>
								</td>
								<td class="actions">
									<a href="/produits/edit/{{ $produit->id }}" class="btn btn-xs btn-info">
										<span class="fa fa-edit"></span> Edition
									</a>
									<a href="/produits/addToCart/{{ $produit->id }}" class="btn btn-xs btn-success">
										<span class="fa fa-plus"></span> Ajouter à la liste courante
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
