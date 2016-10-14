<h1>{{ $title }}</h1>

@if (count($liste->lignesproduits) > 0)
	<table class="table"
		   style="border: 1px solid #dddddd; margin-bottom: 20px; max-width: 100%; width: 100%; border-collapse: collapse; border-spacing: 0;">
		<tbody>
			<tr>
				<td width="3%" style="border: solid 1px #dddddd; font-weight: bold;">&nbsp;</td>
				<td width="3%" style="border: solid 1px #dddddd; font-weight: bold;">Quantite</td>
				<td width="92%" style="border: solid 1px #dddddd; font-weight: bold;">Nom</td>
			</tr>
			@foreach ($liste->lignesproduits as $ligneProduit)
				<tr>
					<td width="3%" style="border: solid 1px #dddddd;">
						{!! Form::checkbox('produits[]', $ligneProduit->id) !!}
					</td>
					<td width="3%" style="border: solid 1px #dddddd;">
						{{ $ligneProduit->quantite }}
					</td>
					<td width="92%" style="border: solid 1px #dddddd;">
						{{ $ligneProduit->produit->nom }}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	Aucun produit dans la liste de course actuellement.
@endif