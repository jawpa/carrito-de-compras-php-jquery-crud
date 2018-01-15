<?php
	session_start();
	include "conexion.php";

	if (isset($_SESSION['Usuario'])) {
		
	}
     // si no está definida la sesión-usuario volvemos al index con un error
	 else{
		header("Location:./index.php?Error=acceso denegado");
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title>Panel de Administración</title>
	<link rel="stylesheet" type="text/css" href="./css/estilos.css">
	<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script> -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript"  href="./js/scripts.js"></script>
</head>
<body>
	<header>
		<img src="./imagenes/logo.jpg" id="logo">
		<a href="./carritodecompras.php" title="ver carrito de compras">
			<img src="./imagenes/carrito.png">
		</a>
	</header>
	<section>
	<nav class="menu2">
	<!-- panel -->
	  <menu>
	    <li><a href="./">Inicio</a></li>
	    <li><a href="#" class="selected">Admin</a></li>
	    <li><a href="./admin/agregarproducto.php" >Agregar</a></li>
	    <li><a href="./admin/modificar.php" >Modificar</a></li>
	    <li><a href="./login/cerrar.php">Salir</a></li>
	  </menu>
	</nav>

	<center><h1>Últimas Compras</h1></center>
	<!-- tabla de las últimas compras -->
	<table border="0px" width="100%">	
		<tr>
			<td>Imagen</td>
			<td>Nombre</td>
			<td>Precio</td>
			<td>Cantidad</td>
			<td>Subtotal</td>
		</tr>	
        <!-- el contenido de la tabla son todas las ventas realizadas -->
		<?php
			$re=mysqli_query($con,"select * from compras");
			$numeroventa=0;
			while ($f=mysqli_fetch_array($re)) {
				    // escribimos el número de venta para agrupar los productos
					if($numeroventa	!=$f['numeroventa']){
						echo '<tr><td>Compra Número: '.$f['numeroventa'].' </td></tr>';
					}
					// obtenemos el número de venta de cada producto
					$numeroventa=$f['numeroventa'];
					// los productos se escribirán abajo de su número-de-venta
					echo '<tr>
						<td><img src="./productos/'.$f['imagen'].'" width="100px" heigth="100px" /></td>
						<td>'.$f['nombre'].'</td>
						<td>'.$f['precio'].'</td>
						<td>'.$f['cantidad'].'</td>
						<td>'.$f['subtotal'].'</td>

					</tr>';
			}
		?>
	</table>
	</section>
</body>
</html>