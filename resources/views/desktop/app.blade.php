<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<!-- jQuery -->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="/js/plugins/morris/raphael.min.js"></script>
    <!-- <script src="/js/plugins/morris/morris.min.js"></script>
    <script src="/js/plugins/morris/morris-data.js"></script> -->

	<script type="text/javascript" src="/js/plugins/mmenu/jquery.mmenu.all.min.js"></script>
	<script type="text/javascript">
		$(function() {
			$('nav#menu').mmenu();
		});
	</script>

	@if (isset($js_files) && is_array($js_files) && !empty($js_files))
		@foreach ($js_files as $js_file)
			<script src="/js/{{$js_file}}"></script>
		@endforeach
	@endif

	<link href="/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/css/jquery-ui.structure.min.css" rel="stylesheet">
	<link href="/css/jquery-ui.theme.min.css" rel="stylesheet">
	<link href="/css/bootstrap.min.css" rel="stylesheet">

	<link href="/css/sb-admin.css" rel="stylesheet">
	<link href="/css/plugins/morris.css" rel="stylesheet">
	<link href="/css/plugins/jquery.mmenu.all.css" rel="stylesheet">
	<link href="/css/global.css" rel="stylesheet">

	@if (isset($css_files) && is_array($css_files) && !empty($css_files))
		@foreach ($css_files as $css_file)
			<link href="/css/{{$css_file}}" rel="stylesheet">
		@endforeach
	@endif

	<!-- Fonts -->
	<link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> -->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!-- Scripts -->
	<script type="text/javascript">
		var baseURL = '{{URL::to('/')}}'
	</script>
</head>
<body>

	<div id="page">

		<div class="header">
			<a href="#menu"><span></span></a>
			Rpi Inventory
		</div>

		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
			        <div class="col-sm-12">
			            {!! App\Helpers\Messages::render() !!}
			        </div>
			    </div>

				<div class="row">
					<div class="page-header clearfix">
						<div class="col-md-6">
							@if (isset($title))
								<h1>{{ $title }}</h1>
							@endif
						</div>
						<div class="col-md-6">
							@if (isset($btnHeading))
								@foreach ($btnHeading as $btn)
									{!! $btn !!}
								@endforeach
							@endif
						</div>
					</div>

					<ol class="breadcrumb">
						@if (isset($breadcrumb))
							@foreach ($breadcrumb as $label => $uri)
		                        <li><a href="{{$uri}}">{{$label}}</a></li>
							@endforeach
						@endif
						<li class="active">{{$title}}</li>
					</ol>
				</div>

				<div class="row">
					@yield('content')
				</div>
			</div>
		</div>


		<!-- Navigation -->
        <nav id="menu" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<ul class="nav navbar-right top-nav">
				<li><a href="/">Accueil</a></li>
				<li><a href="/liste-courses">
						<i class="fa fa-fw fa-shopping-cart"></i> Liste de courses</a>
				</li>
				<li><span><i class="fa fa-fw fa-dropbox"></i> Etat des stocks</span>
					<ul>
						<li><a href="/categories">Catégories</a></li>
						<li><a href="/produits">Produits</a></li>
						<li><a href="/consomation">Consomation</a></li>
					</ul>
				</li>
				<li><span><i class="fa fa-fw fa-cutlery"></i> Recettes</span>
					<ul>
						<li><a href="/recettes">Liste des recettes</a></li>
						<li><a href="/recettes/recherche">Rechercher une recette à partir d'ingrédients</a></li>
					</ul>
				</li>
				<li><span><i class="fa fa-fw fa-calendar"></i> Agenda</span>
					<ul>
						<li><a href="/agendas">Gérer les recettes de la semaine</a></li>
					</ul>
				</li>
			</ul>
		</nav>

	</div>

	<div id="myModal"></div>

</body>
</html>
