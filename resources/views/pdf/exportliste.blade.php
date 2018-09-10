<h1>{{ $title }}</h1>

@if (!empty($productLines))
	<table class="table"
		   style="border: 1px solid #dddddd; margin-bottom: 20px; max-width: 100%; width: 100%; border-collapse: collapse; border-spacing: 0;">
		<tbody>
			<tr>
				<td width="3%" style="border: solid 1px #dddddd; font-weight: bold;">&nbsp;</td>
				<td width="3%" style="border: solid 1px #dddddd; font-weight: bold;">Quantite</td>
				<td width="92%" style="border: solid 1px #dddddd; font-weight: bold;">Nom</td>
			</tr>
			@foreach ($productLines as $productLine)
				<tr>
					<td width="3%" style="border: solid 1px #dddddd;">
						<input type="checkbox" name="produits[]" value="{{ $productLine->id }}" />
					</td>
					<td width="3%" style="border: solid 1px #dddddd;">
						{{ $productLine->quantity }}
					</td>
					<td width="92%" style="border: solid 1px #dddddd;">
						{{ $productLine->product->name }}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	Aucun produit dans la liste de course actuellement.
@endif
