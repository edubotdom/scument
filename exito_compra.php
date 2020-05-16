<?php
include("requires/requires.php");
if(!isset($_SESSION["login"])){
	Header("Location:login.php");
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/pie.css">
		<link rel="stylesheet" href="css/exito_compra.css">
		<title>MONDECOPY</title>
	</head>

	<body>
		<?php
			include_once ("cabecera.php");
			//Una vez realizada la compra, se elimina el carrito.
			unset($_SESSION["carrito"]);
		?>
		<br />
		<br/>
		<?php include_once ("barra_lateral.php"); ?>
			
		<div id="texto"
		<p>Compra realizada con éxito</p>
		<p>¡Gracias por su compra!</p>
		<a id="boton" href="portada.php">Ir a inicio</a>
		</div>
		<?php
			include_once ("pie.php");
		?>

	</body>
</html>