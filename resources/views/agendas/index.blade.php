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
						<div class="clearfix">
							<div class="col-md-9">
								<h3>Liste des ingrédients nécessaire de la semaine</h3>
							</div>
							<div class="col-md-2 text-right marginTop15">
								<a class="btn btn-sm btn-danger" href="/listes-courses/generate" onclick="return(confirm('La génération de la liste écrasera la liste courante. Etes-vous sûr?'));">
									<span class="glyphicon glyphicon-shopping-cart"></span>
									Générer la liste de course
								</a>
							</div>
						</div>

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
