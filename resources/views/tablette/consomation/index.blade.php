@extends('tablette.app')

@section('content')

<div class="col-md-12">

	@include('tablette.consomation.autocomplete')

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

	<div id="products-details"></div>

</div>

@endsection
