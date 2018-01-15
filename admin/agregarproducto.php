<?php
session_start();
	include "../conexion.php";
	if(isset($_SESSION['Usuario'])){

	}else{
		header("Location: ./index.php?Error=Acceso denegado");
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title>Panel de Administración</title>
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript"  src="./js/scripts0.js"></script>
</head>
<body>
	<header>
		<img src="../imagenes/logo.png" id="logo">
		<a href="../carritodecompras.php" title="ver carrito de compras">
			<img src="../imagenes/carrito.png">
		</a>
	</header>
	<section>
	<nav class="menu2">
	  <menu>
	    <li><a href="./">Inicio</a></li>
		<li><a href="../admin.php">Ultimas Compras</a></li>
	    <li><a href="#" class="selected">Agregar</a></li>
	    <li><a href="./login/cerrar.php">Salir</a></li>
	  </menu>
	</nav>

    <!-- enviamos la info a altaproducto.php -->
    <!-- enctype es algo como tipo de encriptación, se incluye cuando subimos imágenes/archivos -->
	<center><h1>Agregar un Nuevo Producto</h1></center>
	<form action="altaproducto.php" method = "post" enctype="multipart/form-data">
		<fieldset>
			Nombre<br>
			<input type="text" name="nombre">
		</fieldset>
		<fieldset>
			Descripción<br>
			<input type="text" name="descripcion">
		</fieldset>
		<fieldset>
			Imagen<br>
			<input type="file" name="file">
		</fieldset>
		<fieldset>
			Precio<br>
			<input type="text" name="precio">
		</fieldset>
		<input type="submit" name="accion" value="Enviar" class="aceptar">
	</form>	
	
		</form>
	</section>
</body>
</html>