@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading clearfix">{{ $title }}</div>
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

					{!! Form::open(array('class' => 'form-horizontal', 'url' => 'produits/add')) !!}
						<div class="form-group">
							<label class="col-md-4 control-label">Categorie</label>
							<div class="col-md-6">
								{!! Form::select('categorie_id', $categories, null, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('nom', 'Nom', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::text('nom', null, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('description', 'Description', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::textarea('description', null, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('quantite', 'Quantité', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::text('quantite', null, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('quantite_min', 'Quantité minimum', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::text('quantite_min', null, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('unite', 'Unité', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::select('unite', $uniteList, null, array('class' => 'form-control')) !!}
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
