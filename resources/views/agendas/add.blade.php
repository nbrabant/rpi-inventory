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

					{!! Form::open(array('class' => 'form-horizontal', 'url' => 'agendas/add', 'files'=>true)) !!}
						<div class="form-group">
							{!! Form::label('recette', 'Recette', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::select('recette_id', $listeRecettes, null, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('date_recette', 'Date recette', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::text('date_recette', null, array('class' => 'form-control datepicker')) !!}
								<span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('moment', 'Moment', array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::select('moment', $listeMoments, null, array('class' => 'form-control')) !!}
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
