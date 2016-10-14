@if (count($recipes) > 0)
	@foreach ($recipes as $recipe)
		<div class="recipe clearfix" style="height: auto; border-bottom: solid 1px #EEE; margin-bottom: 10px;">
			<div class="col-sm-2">
				<img scr="{{ $recipe['img'] }}" alt="{{ $recipe['name'] }}" class="img-responsive"/>
			</div>
			<div class="col-sm-7 bold">
				{{ $recipe['name'] }}
			</div>
			<div class="col-sm-2">
				<button type="button" class="btn btn-sm btn-success populate-recipe" data-url="{{ $recipe['url'] }}">
					Récupération de cette recette
				</button>
			</div>
		</div>
	@endforeach
@else
	<div class="alert alert-warning">Aucun résultat.</div>
@endif
