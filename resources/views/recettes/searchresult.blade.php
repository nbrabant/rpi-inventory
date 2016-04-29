@if (count($recipes) > 0)
	@foreach ($recipes as $recipe)
		<div class="recipe clearfix">
			<div class="col-sm-2">
				@if (strlen($recipe['img']) > 0)
					<img scr="{{ $recipe['img'] }}" alt="{{ $recipe['name'] }}"/>
				@endif
			</div>
			<div class="col-sm-7">
				{{ $recipe['name'] }}
			</div>
			<div class="col-sm-2">
				<button type="button" class="btn btn-xs btn-success" data-url="{{ $recipe['url'] }}">
					Récupération de cette recette
				</button>
			</div>
		</div>
	@endforeach
@else
	<div class="alert alert-warning">Aucun résultat.</div>
@endif
