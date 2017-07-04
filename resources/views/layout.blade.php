<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RPI Inventory</title>

    <style src="{{ elixir('css/app.css', '') }}"></style>
  </head>

  <body>
    <app>
  		<div class="loading-placeholder-wrapper">
  		    <div class="loading-placeholder-inner-wrapper">
  		        <span class="loading-placeholder">Loading...</span>
  		    </div>
  		</div>
  	</app>
  </body>

  <!--   Core JS Files   -->
  <script src="{{ elixir('js/app.js', '') }}"></script>
</html>
