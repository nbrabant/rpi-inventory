@if (count($liste->lignesproduits) > 0)
	<table class="table table-bordered table-hover">
		<thead>
			<tr>
				<th>Nom</th>
				<th>Quantite</th>
				<th>Unité / Conditionnement</th>
				<th class="actions">Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($liste->lignesproduits as $ligneProduit)
				<tr>
					<td>{{ $ligneProduit->produit->nom }}</td>
					<td>
						<div class="clearfix">
							<div class="col-sm-3">
								{{ $ligneProduit->quantite }}
							</div>
							<div class="col-sm-9 btn-adding">
								<a href="listes-courses/changeQty/add/{{ $ligneProduit->id }}" class="btn btn-default">+</a>
								<a href="listes-courses/changeQty/del/{{ $ligneProduit->id }}" class="btn btn-default">-</a>
							</div>
						</div>
					</td>
					<td>{{ !is_null($ligneProduit->produit->unite) ? $ligneProduit->produit->unite : '---' }}</td>
					<td>
						<a href="/listes-courses/delProducts/{{ $ligneProduit->id }}" class="btn btn-sm btn-danger">
							<span class="glyphicon glyphicon-close"></span> Supprimer de la liste
						</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	<div class="alert alert-warning">Aucun produit dans la liste de course actuellement.</div>
@endif
