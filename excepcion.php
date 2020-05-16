<?php
session_start();

$excepcion = $_SESSION["excepcion"];
unset($_SESSION["excepcion"]);

if (isset($_SESSION["destino"])) {
	$destino = $_SESSION["destino"];
	unset($_SESSION["destino"]);
} else
	$destino = "";
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/biblio.css" />
		<title>Mondecopy: ¡Se ha producido un problema!</title>
	</head>
	<body>

		<div>
			<h2>Error en la aplicación</h2>
			<?php if ($destino<>"") {
			?>
			<p>
				Si está viendo esta pantalla, es que ocurrió un problema durante el procesado de los datos y la aplicación se ha interrumpido. Disculpe las molestias, desde el equipo SCUMENT. Pulse <a href="<?php echo $destino ?>">aquí</a> para volver a la página principal.
			</p>
			<?php } else { ?>
			<p>
				Si está viendo esta pantalla, resulta que ocurrió un problema para acceder a la base de datos y la aplicación se ha interrumpido. Disculpe las molestias, desde el equipo SCUMENT.
			</p>
			<?php } ?>
		</div>

		<div class='excepcion'>
			<?php echo "Información relativa al problema, si se encuentra disponible: $excepcion;"
			?>
		</div>
		
		<a href="portada.php" >Portada</a>
		
		<?php
		include_once ("pie.php");
		?>
	</body>
</html>