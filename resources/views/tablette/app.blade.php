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


	@if (isset($userAgent) && $userAgent->match('midori'))
		<!-- Keyboard -->
		<script src="/js/plugins/keyboard/jquery.keyboard.js"></script>
		<script src="/js/plugins/keyboard/jquery.keyboard.extension-typing.min.js"></script>
		<script src="/js/plugins/keyboard/jquery.keyboard.extension-autocomplete.min.js"></script>
		<script src="/js/plugins/keyboard/jquery.keyboard.extension-caret.min.js"></script>
		<script src="/js/keyboard.js"></script>
	@endif

	@if (isset($js_files) && is_array($js_files) && !empty($js_files))
		@foreach ($js_files as $js_file)
			<script src="/js/{{$js_file}}"></script>
		@endforeach
	@endif

	<link href="/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/css/jquery-ui.structure.min.css" rel="stylesheet">
	<link href="/css/jquery-ui.theme.min.css" rel="stylesheet">
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/plugins/keyboard-dark.min.css" rel="stylesheet">

	<link href="/css/tablette.css" rel="stylesheet">

	@if (isset($css_files) && is_array($css_files) && !empty($css_files))
		@foreach ($css_files as $css_file)
			<link href="/css/{{$css_file}}" rel="stylesheet">
		@endforeach
	@endif

	<!-- Fonts -->
	<link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<script type="text/javascript">
		var baseURL = '{{URL::to('/')}}'
	</script>
</head>
<body>

	<div id="page">

		<div class="header clearfix">
			<a href="/"><span class="fa fa-home"></span> Rpi Inventory</a>
			@if (isset($title))
				- {{ $title }}
			@endif

			@if (isset($linkHeading))
				<div id="headingLinks" class="pull-right text-right">
					@foreach ($linkHeading as $key => $link)
						<a href="{!! $link !!}">
							<span class="fa fa-{{ $key }}"></span>
						</a>
					@endforeach
				</div>
			@endif
		</div>

		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
			        <div class="col-sm-12">
			            {!! App\Helpers\Messages::render() !!}
			        </div>
			    </div>

				<div class="row">
					@yield('content')
				</div>
			</div>
		</div>

	</div>

	<div id="myModal"></div>

</body>
</html>
