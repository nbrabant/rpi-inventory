@extends('tablette.app')

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

	{!! Form::model($categorie, array('class' => 'form-horizontal', 'url' => 'categories/edit/'.$categorie->id)) !!}
		<div class="form-group">
			{!! Form::label('nom', 'Nom', array('class' => 'col-md-3 control-label')) !!}
			<div class="col-md-9">
				{!! Form::text('nom', null, array('class' => 'form-control text-keyboard')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('position', 'Position', array('class' => 'col-md-3 control-label')) !!}
			<div class="col-md-9">
				{!! Form::text('position', null, array('class' => 'form-control number-keyboard')) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-9 col-md-offset-3">
				<a href="{{ url().'/categories' }}" class="btn btn-default">
					Retour
				</a>
				{!! Form::submit('Enregistrer', array('class' => 'btn btn-primary')) !!}
			</div>
		</div>
	{!! Form::close() !!}

</div>

@endsection
