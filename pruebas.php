<?php
require_once ("gestionBD.php");
require_once("gestionarUsuarios.php");
require("requires/requires.php");
$conexion = crearConexionBD();
//echo isset($_SESSION["login"]);
//print_r (getIdUsuario($conexion, $_SESSION["login"])[0]);

echo getUsuarioActivo($conexion, $login); //*	$filas = getTransaccionesUsuario($conexion, getIdUsuario($conexion, $_SESSION["login"])[0]);
/*
		?><table>
			<tr>
			<th>
				ID DE TRANSACCION
			</th>
			<th>
				FECHA EJECUCIÓN
			</th>
			<th>
				IMPORTE
			</th>
			<th>
				TIPO DE TRANSACCIÓN
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
				<td class="tipo_transaccion">
					<?php
					echo $fila[3];
					?>
				</td>
			</tr>  					
	<?php } ?>
		</table>
<?php
 
function getTransaccionesUsuario($conexion, $idUsuario) {
	try {
		$stmt = $conexion -> prepare("SELECT id_transaccion,fecha_ejecucion,importe,tipo_transaccion FROM TRANSACCIONES WHERE CLIENTES = :ID_USUARIO");
		$stmt -> bindParam(":ID_USUARIO", $idUsuario);
		$stmt -> execute();
		return $stmt;
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}
/*
function getUsuario($conexion, $usuario) {
	try {
		$stmt = $conexion -> prepare("SELECT login from clientes where login = :login");
		$stmt -> bindParam(":login", $usuario);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}
*/
function prueba($conexion) {
	$stmt = $conexion -> prepare('SELECT login from clientes where login = :login');
	$datos = array(':login' => 'juanogtir');
	try {
		//$stmt = $conexion -> prepare("SELECT login from clientes where login = 'migueltoro'");
		//$stmt -> execute();

		$stmt -> execute($datos);
	} catch(PDOException $e) {
		return $e -> GetMessage();
	}
}

function filtroPrecio($conexion, $precio){
	try{
		$stmt = $conexion-> prepare("SELECT NOMBRE,PRECIO,TIPO_IMPOSITIVO,TASA_FIJA FROM OBJETOS WHERE PRECIO <= :PRECIO");
		$stmt -> bindParam(":PRECIO", $precio);
		$stmt -> execute();
		return $stmt;
	}
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
}

echo prueba($conexion);
?>