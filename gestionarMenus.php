<?php
	function crearMenu($conexion, $login) {
		$user = getUsuario($conexion, $login);
		if(isset($login)){
			$menu = array("Inicio", "Carrito", "Mi perfil", "Desloguear [" . $user['LOGIN'] . "]");
			$href = array("portada.php", "carrito.php", "mis_datos.php", "logout.php");
			$numElementos = count($menu);
			for($i=0; $i < $numElementos; $i++) {
		
?>
			<link rel="stylesheet" href="css/menu.css">
			<nav align="right" class="menu" id="menu<?php echo $i ?>">
				<a href="<?php echo $href[$i]; ?>"> <?php echo $menu[$i]; ?></a>
			</nav>
<?php
}
} else {
?>
			<link rel="stylesheet" href="css/menu.css">
			<nav align="right" class="menu" id="menu0">
				<a href="login.php">Acceder</a>
			</nav>
<?php
}
			?>

<?php
}
?>

<?php
	function crearMenuEmpleado($conexion, $login) {
		$user = getEmpleado($conexion, $login);
		if(isset($login)){
			$menu = array("Inicio", "Mi perfil", "Desloguear [" . $user['LOGIN'] . "]");
			$href = array("panel_de_administracion.php", "mis_datos_empleado.php", "logout_empleado.php");
			$numElementos = count($menu);
			for($i=0; $i < $numElementos; $i++) {
		
?>
			<link rel="stylesheet" href="css/menu.css">
			<nav align="right" class="menu" id="menu<?php echo $i ?>">
				<a href="<?php echo $href[$i]; ?>"> <?php echo $menu[$i]; ?></a>
			</nav>
<?php
}
} else {
?>
			<link rel="stylesheet" href="css/menu.css">
			<nav align="right" class="menu" id="menu0">
				<a href="login_empleado.php">Acceder</a>
			</nav>
<?php
}
			?>

<?php
}
?>



<?php
function crearMenuPortada() {
?>
<nav id="menu" align="middle">
	<div id="ofertas">
		<div>
			<a class="button" href="catalogo_oferta.php">OFERTAS</a>
		</div>
		<div class="imagen">
			<img src="images/39887.png">
		</div>
	</div>
	<div id="ctrl_precio">
		<div>
			<a class="button" href="catalogo_seleccionable.php">SELECTOR</a>
		</div>
		<div class="imagen">
			<img src="images/31117.png">
		</div>
	</div>	
	<div id="productos">
		<div>
			<a class="button" href="catalogo_producto.php">PRODUCTOS</a>
		</div>
		<div class="imagen">
			<img src="images/impresora.png">
		</div>
	</div>
	<div id="servicios">
		<div>
			<a class="button" href="catalogo_servicio.php">SERVICIOS</a>
		</div>
		<div class="imagen">
			<img src="images/18392.png">
		</div>
	</div>
	<div id="localizacion">
		<div>
			<a class="button" href="localizacion.php">LOCALÍCENOS</a>
		</div>
		<div class="imagen">
			<img src="images/ubicacion-marca.png">
		</div>
	</div>
	<div id="contactenos">
		<div>
			<a class="button" href="contactenos.php">CONTÁCTENOS</a>
		</div>
		<div class="imagen">
			<img src="images/5a452601546ddca7e1fcbc87.png">
		</div>
	</div>
</nav>
<?php
}
?>

<?php
function crearMenuPortadaEmpleado() {
?>

<nav id="menu" align="middle">
	<div id="modificar_productos">
		<div>
			<a class="button" href="modificar_productos.php">MODIFICAR PRODUCTOS</a>
		</div>
		<div class="imagen">
			<img src="images/impresora.png">
		</div>
	</div>
	<div id="modificar_servicios">
		<div>
			<a class="button" href="modificar_servicios.php">MODIFICAR SERVICIOS</a>
		</div>
		<div class="imagen">
			<img src="images/18392.png">
		</div>
	</div>
	<div id="bajas">
		<div>
			<a class="button" href="transacciones_asignadas.php">LISTAR USUARIOS</a>
		</div>
		<div class="imagen">
			<img src="images/585e4bf3cb11b227491c339a.png">
		</div>
	</div>
</nav>
<?php
}
?>