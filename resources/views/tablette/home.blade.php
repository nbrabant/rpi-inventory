@extends('tablette.app')

@section('content')

<div class="col-sm-8">

	<ul id="home_links">
		<li>
			<a href="/agendas" class="home_link">
				<i class="fa fa-fw fa-calendar"></i> Agenda
			</a>
		</li>
		<li>
			<a href="/recettes" class="home_link">
				<i class="fa fa-fw fa-cutlery"></i> Recettes
			</a>
		</li>
		<li>
			<a href="/liste-courses" class="home_link">
				<i class="fa fa-fw fa-shopping-cart"></i> Liste de courses
			</a>
		</li>
		<li>
			<a href="/produits" class="home_link">
				<i class="fa fa-fw fa-cutlery"></i> Produits
			</a>
		</li>
		<li>
			<a href="/consomation" class="home_link">
				<i class="fa fa-fw fa-dropbox"></i> Consomation
			</a>
		</li>
	</ul>

</div>

<div class="col-sm-4">

	<svg xmlns="http://www.w3.org/2000/svg" width="200" height="200">
		<title>Horloge analogique SVG</title>
		<desc>Affiche l’heure en Temps universel coordonné (UTC).</desc>
		<defs>
			<line id="oHeure" x1="100" y1="100" x2="100" y2="45" style="stroke-width: 6px; stroke: white;"/>
			<line id="oMinute" x1="100" y1="100" x2="100" y2="15" style="stroke-width: 4px; stroke: white;"/>
			<line id="oSeconde" x1="100" y1="100" x2="100" y2="5" style="stroke-width: 2px; stroke: red;"/>
			<script type="text/javascript">

					function twAjusteHeure(e) {
						var d = new Date();
						var s = d.getSeconds();
						var m = d.getMinutes() + s / 60;
						var h = d.getHours() + m / 60;
						var svg = e.target.ownerDocument;
						svg.getElementById("oSeconde").setAttribute("transform", "rotate(" + (s * 6) + ", 100, 100)");
						svg.getElementById("oMinute").setAttribute("transform", "rotate(" + (m * 6) + ", 100, 100)");
						svg.getElementById("oHeure").setAttribute("transform", "rotate(" + (h * 30) + ", 100, 100)");
					}

			</script>
		</defs>
		<g>
			<circle id="circle" style="stroke: white; fill: transparent;" cx="100" cy="100" r="100"/>
			<line style="stroke: white;" id="hour0" x1="100" y1="10" x2="100" y2="0"/>
			<line style="stroke: white;" id="hour1" x1="150" y1="13" x2="145" y2="22"/>
			<line style="stroke: white;" id="hour2" x1="187" y1="50" x2="178" y2="55"/>
			<line style="stroke: white;" id="hour3" x1="190" y1="100" x2="200" y2="100"/>
			<line style="stroke: white;" id="hour4" x1="187" y1="150" x2="178" y2="145"/>
			<line style="stroke: white;" id="hour5" x1="150" y1="187" x2="145" y2="178"/>
			<line style="stroke: white;" id="hour6" x1="100" y1="190" x2="100" y2="200"/>
			<line style="stroke: white;" id="hour7" x1="50" y1="187" x2="55" y2="178"/>
			<line style="stroke: white;" id="hour8" x1="13" y1="150" x2="22" y2="145"/>
			<line style="stroke: white;" id="hour9" x1="0" y1="100" x2="10" y2="100"/>
			<line style="stroke: white;" id="hour10" x1="13" y1="50" x2="22" y2="55" />
			<line style="stroke: white;" id="hour11" x1="50" y1="13" x2="55" y2="22" />
		</g>
		<g>
			<use xlink:href="#oHeure">
				<animateTransform attributeName="transform" type="rotate" dur="43200s" values="0, 100, 100; 360, 100, 100" repeatCount="indefinite" />
			</use>
		</g>
		<g>
			<use xlink:href="#oMinute">
				<animateTransform attributeName="transform" type="rotate" dur="3600s" values="0, 100, 100; 360, 100, 100" repeatCount="indefinite" />
			</use>
		</g>
		<g>
			<use xlink:href="#oSeconde">
				<animateTransform attributeName="transform" type="rotate" dur="60s" values="0, 100, 100; 360, 100, 100" repeatCount="indefinite" />
			</use>
		</g>
	</svg>

</div>

@endsection
