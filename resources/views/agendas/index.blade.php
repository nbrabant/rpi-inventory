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
						<a href="/agendas/add" class="btn btn-sm btn-success">
							<span class="glyphicon glyphicon-plus"></span> Ajouter
						</a>
					</div>
				</div>
				<div class="panel-body">
					{!! $calendar !!}

					@if (!empty($produits))
						<h3>Liste des ingrédients nécessaire de la semaine</h3>
						<table class="table">
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
										<td>{{ $produit->necessaire }}</td>
										<td>{{ $produit->en_stock }}</td>
										<td>{{ $produit->manquant }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
