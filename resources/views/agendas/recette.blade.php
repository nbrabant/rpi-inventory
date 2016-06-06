<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">{{ $title }}</h4>
		</div>
		<div class="modal-body">
			<div class="col-sm-12">
				{!! $recette->getImage() !!}
			</div>
			<div class="col-sm-12">
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
								<li>{{ $ingredient->quantite }} {{ $ingredient->produit->nom }}</li>
							@endforeach
						</ul>
						@endif
						@if (!is_null($recette->complement))
							{{ $recette->complement }}
						@endif
					</div>
				@endif
			</div>
			<div class="clearfix">
				{!! $recette->instructions !!}
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
			@if (!$agenda->realise)
				<a href="agendas/realise/{{ $agenda->id }}" class="btn btn-primary">Recette réalisée</a>
				<a href="agendas/delete/{{ $agenda->id }}" class="btn btn-danger">Supprimer de l'agenda</a>
			@endif
		</div>
	</div>
</div>
