@extends('tablette.app')

@section('content')

<div class="col-md-12">

	{!! $calendar !!}

	@if (!empty($produits))
		<div class="clearfix">
			<h3>Liste des ingrédients nécessaire de la semaine</h3>
		</div>

		<table class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Quantité nécessaire</th>
					<th>Quantité en stock</th>
					<th>Quantité manquante</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($produits as $produit)
					<tr>
						<td>{{ $produit->produit_nom }}</td>
						<td>{{ $produit->necessaire }} {{ !is_null($produit->unite) ? $produit->unite : '' }}</td>
						<td>{{ $produit->en_stock }} {{ !is_null($produit->unite) ? $produit->unite : '' }}</td>
						<td>
							@if ($produit->manquant > 0)
								{{ $produit->manquant }} {{ !is_null($produit->unite) ? $produit->unite : '' }}
							@else
								---
							@endif
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif

</div>

@endsection
