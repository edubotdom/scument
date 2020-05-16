<?php
require_once("gestionBD.php");

//Código que se ejecutará en la llamada AJAX a este script

// Si llegamos a este script por haber seleccionado una provincia
if(isset($_GET["precioSeleccionado"])){
	// Abrimos una conexión con la BD y consultamos la lista de municipios dada una provincia
	$conexion = crearConexionBD();
	$resultado = filtroPrecio($conexion, $_GET["precioSeleccionado"]);
	//echo $_GET["precioSeleccionado"];
	//echo "holi1";
	if($resultado != NULL){
		//echo "holi2";
		// Para cada municipio del listado devuelto
		//print_r($resultado);
		foreach($resultado as $fila){
			// Creamos options con valores = oid_municipio y label = nombre del municipio
			//echo "<option label='" . $municipio["NOMBRE"] . "' value='" . $municipio["OID_MUNICIPIO"] . "'/>";	
			echo "<article class='OBJETOS'>";
			echo "<div class='nombre'>";
				echo "<p><b>" . " Nombre:</b> <b>" . $fila[0] . "</b></p>";
			echo "</div>";
			echo "<div class='precio'>";
				echo "<p><b>" . "Precio:</b> " . $fila[1] . "€" . "</p>";
			echo "</div>";
			echo "</article>";
			
			//FORMULARIO PARA CARRITO
			/*
				<form action="detalle_producto.php" method="post" target="_blank">
				<input type="hidden" name="id_producto" id="id_producto"
					value="<?php echo $fila[strtoupper("id_producto")]; ?>" />
				<input type="hidden" name="precio" id="precio"
					value="<?php echo $fila[strtoupper("precio")]; ?>" />
				<input type="hidden" name="precio_alquiler" id="precio_alquiler"
					value="<?php echo $fila[strtoupper("precio_alquiler")]; ?>" />
				<input type="hidden" name="descripcion" id="descripcion"
					value="<?php echo $fila[strtoupper("descripcion")]; ?>" />
				<input type="hidden" name="cantidad_total" id="cantidad_total"
					value="<?php echo $fila[strtoupper("cantidad_total")]; ?>" />
				<input type="hidden" name="dimensiones" id="dimensiones"
					value="<?php echo $fila[strtoupper("dimensiones")]; ?>" />								
				<input type="hidden" name="foto_url" id="foto_url"
					value="<?php echo $fila[strtoupper("foto_url")]; ?>" />
				<input type="hidden" name="nombre" id="nombre"
					value="<?php echo $fila[strtoupper("nombre")]; ?>" />
				<input type="hidden" name="tipo_impositivo" id="tipo_impositivo"
					value="<?php echo $fila[strtoupper("tipo_impositivo")]; ?>" />
				<input type="hidden" name="tasa_fija" id="tasa_fija"
					value="<?php echo $fila[strtoupper("tasa_fija")]; ?>" />
				<input type="hidden" name="marca" id="marca"
					value="<?php echo $fila[strtoupper("marca")]; ?>" />
				<input type="hidden" name="fabricante" id="fabricante"
					value="<?php echo $fila[strtoupper("fabricante")]; ?>" />
				<input type="hidden" name="peso" id="peso"
					value="<?php echo $fila[strtoupper("peso")]; ?>" />
				
				<button class="compra" name="compra" type = "submit">
					<b>Más información</b>
				</button>
				
				</form>
		*/
		}
	}
	// Cerramos la conexión y borramos de la sesión la variable "provincia"
	cerrarConexionBD($conexion);
	unset($_GET["precioSeleccionado"]);
}


// Función que devuelve el listado de municipios de una provincia dada
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

// FIN DE EJERCICIO 4 
?>