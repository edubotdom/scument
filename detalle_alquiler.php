<?php 
//requiere ejecutar primero gestionBD.php para el acceso de los datos a la Base de Datos
require_once("gestionBD.php");
//restricción que los productos tengan precio_alquiler
$filas = consultarTodosAlquileres($conexion);
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>MONDECOPY SL.</title>
	</head>
		<?php
			include_once ("cabecera.php");
		?>
	<body>
		<header>Alquileres</header>
		 <main>
		
			<?php
				foreach($filas as $fila) {
			?>
			
			<article class="ALQUILERES">
				
				<?php 
				echo "<title>" . $fila["nombre"] . "</title>";
				?>
				
				<?php
				echo "<h2>Descripción:</h2>";
				echo "<p>" . $fila["descripcion"] . "</p>";
				?>
				
				<?php
				echo "<a href= " . $fila["foto_url"] . "> Imagen de producto </a>";
				?>
				
				<form action="carrito.php" method="post" target="_blank">
	  				<p>Cantidad <input type="number" name="cantidad"></p>
				</form>
				
				<?php
					echo "<p>" . $fila["precio_alquiler"] . "€" . "</p>";
				?>
				
				<button name="compra" type = "submit">Alquilar</button>
			
			</article>
			
			<?php
				}
			?>
			
		</main>
	</body>
	<br>
		<?php
			include_once ("pie.php");
		?>
	<br>
</html>