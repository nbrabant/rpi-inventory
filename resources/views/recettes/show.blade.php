@extends('app')

@section('content')

<div id="admin-recette" class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<div class="col-sm-12">
						<h1>{{ $title }}</h1>
					</div>
				</div>
			</div>
			<div class="clearfix">
				<div class="col-md-5">
					{!! $recette->getImage() !!}
				</div>
				<div class="col-md-7">
					<div class="clearfix">
						<div class="col-md-5 bold">Type de recette</div>
						<div class="col-md-6">{{ $recette->type_recette }}</div>
					</div>
					<div class="clearfix">
						<div class="col-md-5 bold">Nombre de personnes</div>
						<div class="col-md-6">{{ $recette->nombre_personnes }}</div>
					</div>
					<div class="clearfix">
						<div class="col-md-5 bold">Temps de préparation</div>
						<div class="col-md-6">{{ $recette->temps_preparation }}</div>
					</div>
					<div class="clearfix">
						<div class="col-md-5 bold">Temps de cuisson</div>
						<div class="col-md-6">{{ $recette->temps_cuisson }}</div>
					</div>
					@if (count($ingredients) > 0 || !is_null($recette->complement))
						<div id="liste_produits" class="box clearfix">
							<div class="col-md-12 bold">Liste des ingrédients</div>
							@if (count($ingredients) > 0)
							<ul>
								@foreach ($ingredients as $ingredient)
									<li>
										{{ $ingredient->quantite . (!is_null($ingredient->unite) ? ' ' . $ingredient->getUnite() : '') }} {{ $ingredient->produit->nom }}
									</li>
								@endforeach
							</ul>
							@endif
							@if (!is_null($recette->complement))
								{{ $recette->complement }}
							@endif
						</div>
					@endif
				</div>
			</div>
			<div class="clearfix">
				{!! $recette->instructions !!}
			</div>
		</div>
	</div>
</div>

@endsection
