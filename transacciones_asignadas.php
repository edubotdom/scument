<?php 
require_once("gestionBD.php");
require_once("gestionarUsuarios.php");
require("requires/requires.php");
$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/pie.css">
		<link rel="stylesheet" href="css/mis_pedidos.css">
		<title>MONDECOPY SL.</title>
	</head>
	<?php
	include_once ("cabecera_empleado.php");
	function getTodosUsuarios($conexion) {
	try {
		$stmt = $conexion -> prepare("SELECT DNI_CIF,NOMBRE,DIRECCION,CORREO_ELECTRONICO,TELEFONO_MOVIL,TIPO_CLIENTE FROM CLIENTES");
		$stmt -> execute();
		return $stmt;
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}
	?>
	<body>
	<p id="titulo">Usuarios registrados en la plataforma</p>
		<?php
	$filas = getTodosUsuarios($conexion);
	
	if(count($filas)==0){
		?> <p>No hay usuarios registrados.</p><?php
	} else {

		?><table id="transacciones">
			<tr>
			<th>
				DNI_CIF
			</th>
			<th>
				NOMBRE
			</th>
			<th>
				DIRECCIÓN
			</th>
			<th>
				CORREO ELECTRÓNICO
			</th>
			<th>
				TELEFONO MÓVIL
			</th>
			<th>
				TIPO DE CLIENTE
			</th>
			</tr>
			<?php
	foreach($filas as $fila) {
			?>
			<tr>
				<td class="id_transaccion">
					<?php
					echo $fila[0];
					?>
				</td>
				<td class="fecha_ejecucion">
					<?php
					echo $fila[1];
					?>
				</td> 
				<td class="importe">
					<?php
					echo $fila[2];
					?>
				</td> 
				<td class="importe">
					<?php
					echo $fila[3];
					?>
				</td>
				<td class="importe">
					<?php
					echo $fila[4];
					?>
				</td>
				<td class="tipo_transaccion">
					<?php
					echo $fila[5];
					?>
				</td>
			</tr>  					
	<?php } ?>
		</table>
		<?php } ?>	
	</body>
	<br>
	<?php
	include_once ("pie.php");
	?>
	<br>
</html>