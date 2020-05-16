<?php
require_once ("requires/requires.php");

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/pie.css">
		<link rel="stylesheet" href="css/localizacion.css">

		<title>MONDECOPY SL.</title>
		<script src="http://js.api.here.com/v3/3.0/mapsjs-core.js"
		type="text/javascript" charset="utf-8"></script>
		<script src="http://js.api.here.com/v3/3.0/mapsjs-service.js"
		type="text/javascript" charset="utf-8"></script>
		<script src="http://js.api.here.com/v3/3.0/mapsjs-mapevents.js"
		type="text/javascript" charset="utf-8"></script>
	</head>
	
	<?php
	include_once ("cabecera.php");
	?>
	<header>
		<b>Localización</b>
	</header>
	<?php crearMenu($conexion, $login); ?>
	<br />
	<?php include_once ("barra_lateral.php"); ?>
	<body>

		<div align="middle">
			<br />
			<br />
			<br />
			<p>
				Nuestra tienda física se localiza en la calle Ángel Falquina, número 16 en Sevilla. Código postal, 41008
			</p>
			<!--<img class="localizacion" src="images/Localización.png" alt= "Localizacion" title = "Localizacion del local" />-->
			<br />
		</div>

			<div class="resultados">
				<div id="result2">
				<!--Position information will be inserted here-->
			</div>

			<div style="width: 640px; height: 480px" id="mapContainer">
				<!--Position information will be inserted here-->
			</div>

		
		<script>
			// Initialize the platform object:
			var platform = new H.service.Platform({
				'app_id' : 'eH4E6e9Qf0s9wJhKk3y1',
				'app_code' : 'J9X9Z-6Afj8y_XejA778fg'
			});

			// Obtain the default map types from the platform object
			var maptypes = platform.createDefaultLayers();

			// Instantiate (and display) a map object:
			var map = new H.Map(document.getElementById('mapContainer'),
					maptypes.normal.map, {
						zoom : 12,
						center : {
							lng : -5.976672,
							lat : 37.401055
						}
					});

			// Enable the event system on the map instance:
			var mapEvents = new H.mapevents.MapEvents(map);

			// Add event listeners:
			map.addEventListener('tap', function(evt) {
				// Log 'tap' and 'mouse' events:
				console.log(evt.type, evt.currentPointer.type);
			});

			// Instantiate the default behavior, providing the mapEvents object: 
			var behavior = new H.mapevents.Behavior(mapEvents);

			// Define a variable holding SVG mark-up that defines an icon image:
			var svgMarkup = '<svg width="320" height="24" ' +
      'xmlns="http://www.w3.org/2000/svg">'
					+ '<rect stroke="white" fill="#1b468d" x="1" y="1" width="120" ' +
      'height="22" /><text x="60" y="18" font-size="12pt" ' +
      'font-family="Arial" font-weight="bold" text-anchor="middle" ' +
      'fill="white">MONDECOPY</text></svg>';

			// Create an icon, an object holding the latitude and longitude, and a marker:
			var icon = new H.map.Icon(svgMarkup), coords = {
				lng : -5.976672,
				lat : 37.401055
			}, marker = new H.map.Marker(coords, {
				icon : icon
			});

			// Add the marker to the map and center the map at the location of the marker:
			map.addObject(marker);
			//map.setCenter(coords);
		</script>

		<script type="text/javascript">
			var svgMarkup2 = '<svg width="140" height="30" ' +
    'xmlns="http://www.w3.org/2000/svg">'
					+ '<rect stroke="red" fill="#FF0000" x="1" y="1" width="75" ' +
    'height="22" /><text x="37" y="18" font-size="10pt" ' +
    'font-family="Arial" font-weight="bold" text-anchor="middle" ' +
    'fill="white">ESTA AQUI</text></svg>';
			function showPosition() {
				if (navigator.geolocation) {
					navigator.geolocation
							.getCurrentPosition(function(position) {
								coordsUsu = {
									lat : position.coords.latitude,
									lng : position.coords.longitude
								};
								map.setCenter(coordsUsu);

								var icon2 = new H.map.Icon(svgMarkup2), marker2 = new H.map.Marker(
										coordsUsu, {
											icon : icon2
										});
								map.addObject(marker2);
							});
				} else {
					alert("Sorry, your browser does not support HTML5 geolocation.");
				}
			}
		</script>

		
		<button id="boton" type="button" onclick="showPosition();">¡Localízate
			en el mapa!</button>


	</body>
	<br>
	<?php
	include_once ("pie.php");
	?>
	<br>
</html>