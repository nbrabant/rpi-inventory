<!doctype html>
<html lang="en">

<head>
	<title>RPI Inventory</title>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />

	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<!-- <link href='//fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'> -->

    <meta name="payload"
        data-csrf-token="{{ csrf_token() }}"
        @if ($errors->has())
            data-errors="{{ json_encode($errors->all()) }}"
        @endif
    >
</head>

<body class="nav-md">
	<app>
		<div class="loading-placeholder-wrapper">
		    <div class="loading-placeholder-inner-wrapper">
		        <span class="loading-placeholder">Loading...</span>
		    </div>
		</div>
	</app>
</body>

<!--   Core JS Files   -->
<script src="{{ elixir('polyfills.js', '') }}"></script>
<script src="{{ elixir('vendor.js', '') }}"></script>
<script src="{{ elixir('main.js', '') }}"></script>
<script src="{{ elixir('style.js', '') }}"></script>

</html>
