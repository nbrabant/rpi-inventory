@extends('app')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">
					<div class="col-sm-12">
						<h1>{{ $title }}</h1>
					</div>
					<div class="col-sm-12">{{ $produit->description }}</div>
					<div class="clearfix">
						<div class="col-sm-4">
							Quantité actuelle
						</div>
						<div class="col-sm-8">
							{{ $produit->quantite }}
						</div>
					</div>
					<div class="clearfix">
						<div class="col-sm-4">
							Quantité mini de réapprovisionnement
						</div>
						<div class="col-sm-8">
							{{ $produit->quantite_min }}
						</div>
					</div>
				</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					@if (count($operations) > 0)
						<h1>Liste des opérations</h1>

						<table class="table">
							<thead>
								<th>
									<th>Date</th>
									<th>Détail</th>
									<th>Type d'opération</th>
									<th>Quantité</th>
								</th>
							</thead>
							<tbody>
								@foreach ($operations as $operation)
									<tr>
										<td></td>
										<td>{{ $operation->created_at }}</td>
										<td>{{ $operation->detail }}</td>
										<td>{{ ($operation->operation == '+' ? 'ajout' : 'retrait') }}</td>
										<td>{{ $operation->quantite }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					@else
						<div class="alert alert-warning">Aucun résultat.</div>
					@endif
				</div>
				<div class="panel-footer">
					{!! Form::open(array('class' => 'form-horizontal', 'url' => 'produits/show/'.$produit->id)) !!}
						<h1>Nouvelle opération</h1>

						<div class="form-group">
							{!! Form::label('operation', 'Opération', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::select('operation', ['+' => 'ajout', '-' => 'retrait'], null, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('quantite', 'Quantité', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::text('quantite', null, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('detail', 'Détail', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::text('detail', null, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								{!! Form::submit('Enregistrer', array('class' => 'btn btn-primary')) !!}
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
