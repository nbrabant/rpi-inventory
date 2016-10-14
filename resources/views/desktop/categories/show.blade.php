@extends('desktop.app')

@section('content')

<div class="col-md-12">

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

	@if (count($produits) > 0)
		<table class="table table-bordered table-hover">
			<thead>
				<th>
					<th>Nom</th>
					<th>Etat du stock</th>
					<th class="actions">Actions</th>
				</th>
			</thead>
			<tbody>
				@foreach ($produits as $produit)
					<tr>
						<td>{{ $produit->id }}</td>
						<td>{{ $produit->nom }}</td>
						<td class="{{ $produit->getStatus() }}">{{ $produit->quantite }}</td>
						<td>
							<a href="/produits/show/{{ $produit->id }}" class="btn btn-sm btn-primary">
								<span class="glyphicon glyphicon-eye-open"></span> Voir les opérations sur le produits
							</a>
							<a href="/produits/edit/{{ $produit->id }}" class="btn btn-sm btn-info">
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
