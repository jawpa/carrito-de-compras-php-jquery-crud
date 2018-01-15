<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title>Panel de Administración</title>
	<link rel="stylesheet" type="text/css" href="./css/estilos.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript"  href="./js/scripts0.js"></script>
</head>
<body>
	<header>
		<img src="./imagenes/logo.jpg" id="logo">
		<a href="./carritodecompras.php" title="ver carrito de compras">
			<img src="./imagenes/carrito.png">
		</a>
	</header>
	<section>
	<!-- por seguridad enviamos la info por el método post a la página verificar.php -->
	<form id="formulario" method="post" action="./login/verificar.php">
		<?php 
		// si verificar.php nos devuelve un error
		// escribimos un mensaje de error en la página
		if(isset($_GET['error'])){
			echo '<center>Datos No Validos</center>';
		}
		?>
		<label for="usuario">Usuario</label><br>
		<input type="text" id="usuario" name="usuario" placeholder="usuario" ><br>
		<label for="password">Password</label><br>
		<input type="password" id="password" name="password" placeholder="password" ><br>
		<input type="submit" name="aceptar" value="Aceptar" class="aceptar">
	</form>
	</section>
</body>
</html>