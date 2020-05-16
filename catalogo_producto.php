<?php
require_once ("requires/requires.php");

// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
// ¿Hay una sesión activa?
if (isset($_SESSION["paginacion"]))
	$paginacion = $_SESSION["paginacion"];
$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 4);
if ($pagina_seleccionada < 1)
	$pagina_seleccionada = 1;
if ($pag_tam < 1)
	$pag_tam = 4;

// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
unset($_SESSION["paginacion"]);

// La consulta que ha de paginarse
$query = 'SELECT NOMBRE,PRECIO,ID_PRODUCTO,TIPO_IMPOSITIVO,TASA_FIJA,MARCA,FABRICANTE,PESO,FOTO_URL,DIMENSIONES,CANTIDAD_TOTAL,DESCRIPCION,PRECIO_ALQUILER' . ' FROM OBJETOS ' . 'ORDER BY NOMBRE';

// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
$total_registros = total_consulta($conexion, $query);
$total_paginas = (int)($total_registros / $pag_tam);
if ($total_registros % $pag_tam > 0)
	$total_paginas++;
if ($pagina_seleccionada > $total_paginas)
	$pagina_seleccionada = $total_paginas;

// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
$paginacion["PAG_NUM"] = $pagina_seleccionada;
$paginacion["PAG_TAM"] = $pag_tam;
$_SESSION["paginacion"] = $paginacion;

$filas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/cabecera.css">
		<link rel="stylesheet" href="css/pie.css">
		<link rel="stylesheet" href="css/catalogo_producto.css">
		<link rel="stylesheet" href="css/barra_lateral.css">
		
		<title>MONDECOPY SL.</title>
	</head>
	<?php
	include_once ("cabecera.php");
	?>
	<body>
		<header>
			<b>Productos</b>
		</header>
		<?php crearMenu($conexion, $login); ?>
		<br />
		<main>

<nav>
		<div id="enlaces">
			<?php
				for( $pagina = 1; $pagina <= $total_paginas; $pagina++ ) 
					if ( $pagina == $pagina_seleccionada) { 	?>
						<span class="current"><?php echo $pagina; ?></span>
			<?php }	else { ?>			
						<a href="catalogo_producto.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
			<?php } ?>			
		</div>
		
		<form method="get" action="catalogo_producto.php">
			<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>
			Mostrando 
			<input id="PAG_TAM" name="PAG_TAM" type="number" 
				min="1" max="<?php echo $total_registros;?>" 
				value="<?php echo $pag_tam?>" autofocus="autofocus" /> 
			entradas de <?php echo $total_registros?>
			<input type="submit" value="Cambiar">
		</form>
	</nav>

<?php include_once ("barra_lateral.php"); ?>
			 
			<?php
foreach($filas as $fila) {
			?>
			<article class="OBJETOS">
				
				<div class="nombre">
					<?php
					echo "<p><b>" . " Nombre:</b> <b>" . $fila[strtoupper("nombre")] . "</b></p>";
					?>
				</div>
				<form id="informacion" action="detalle_producto.php" method="post" target="_blank">
				<div class="precio">
					<?php
					echo "<p><b>" . "Precio:</b> " . $fila[strtoupper("precio")] . "€" . "</p>";
					?>
				</div>
				
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
				<hr id="barra"/>
				</form>
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