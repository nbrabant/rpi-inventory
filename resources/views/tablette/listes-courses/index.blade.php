@extends('tablette.app')

@section('content')

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

<div class="clearfix">
	@include('tablette.listes-courses.autocomplete')
	@include('tablette.listes-courses.outofstock')
</div>

<div id="liste-courses" class="clearfix">
	<div class="col-md-12">
		<h3>Liste de courses</h3>
	</div>
</div>
<div id="liste-courses-products">
	@include('tablette.listes-courses.productslist')
</div>

@endsection
