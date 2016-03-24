<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="/css/app.css" rel="stylesheet">
	<link href="/css/global.css" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<script src="/js/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/jquery-ui.min.js"></script>

	@if (isset($js_files) && is_array($js_files) && !empty($js_files))
		@foreach ($js_files as $js_file)
			<script src="/js/{{$js_file}}"></script>
		@endforeach
	@endif

	<link href="/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/css/jquery-ui.structure.min.css" rel="stylesheet">
	<link href="/css/jquery-ui.theme.min.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript">
		var baseURL = '{{URL::to('/')}}'
	</script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">

	<!-- Scripts -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">Rpi Inventory</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="/liste-courses">Liste de courses</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							Etat des stocks <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="/categories">Catégories</a></li>
							<li><a href="/produits">Produits</a></li>
						</ul>
					</li>
					<li class="dropdown"><a href="/produits">Trouver une recette</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="row">
        <div class="col-sm-12">
            {!! App\Helpers\Messages::render() !!}
        </div>
    </div>

	@yield('content')
</body>
</html>
