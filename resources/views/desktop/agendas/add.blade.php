@extends('desktop.app')

@section('content')

<div class="col-md-12">

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

	{!! Form::open(array('class' => 'form-horizontal', 'url' => 'agendas/add', 'files'=>true)) !!}
		<div class="form-group">
			{!! Form::label('recette', 'Recette', array('class' => 'col-md-3 control-label')) !!}
			<div class="col-md-9">
				{!! Form::select('recette_id', $listeRecettes, null, array('class' => 'form-control select2')) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('date_recette', 'Date recette', array('class' => 'col-md-3 control-label')) !!}
			<div class="col-md-9">
				<div class="input-group">
					{!! Form::text('date_recette', null, array('class' => 'form-control datepicker')) !!}
					<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('moment', 'Moment', array('class' => 'col-md-3 control-label')) !!}
			<div class="col-md-9">
				{!! Form::select('moment', $listeMoments, null, array('class' => 'form-control')) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-9 col-md-offset-3">
				<a href="{{ url().'/agendas' }}" class="btn btn-default">
					Retour
				</a>
				{!! Form::submit('Enregistrer', array('class' => 'btn btn-primary')) !!}
			</div>
		</div>
	{!! Form::close() !!}

</div>

@endsection
