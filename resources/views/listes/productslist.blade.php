@if (count($liste->lignesproduits) > 0)
	<table class="table">
		<thead>
			<th>
				<th>Nom</th>
				<th>Quantite</th>
				<th class="actions">Actions</th>
			</th>
		</thead>
		<tbody>
			@foreach ($liste->lignesproduits as $ligneProduit)
				<tr>
					<td></td>
					<td>{{ $ligneProduit->produit->nom }}</td>
					<td>
						<div class="clearfix">
							<div class="col-sm-3">
								{{ $ligneProduit->quantite }}
							</div>
							<div class="col-sm-9 btn-adding">
								<a href="listes/changeQty/add/{{ $ligneProduit->id }}" class="btn btn-default">+</a>
								<a href="listes/changeQty/del/{{ $ligneProduit->id }}" class="btn btn-default">-</a>
							</div>
						</div>
					</td>
					<td>
						<a href="/listes/delProducts/{{ $ligneProduit->id }}" class="btn btn-sm btn-danger">
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
