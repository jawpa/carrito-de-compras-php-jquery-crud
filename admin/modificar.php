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
	<script type="text/javascript" src="./modificar.js"></script>
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
			<!-- el menú de la app con la página misma seleccionada -->
				<li><a href="../">Inicio</a></li>
				<li><a href="../admin.php">Ultimas Compras</a></li>
	    		<li><a href="./agregarproducto.php" >Agregar</a></li>
	    		<li><a href="./modificar.php" class="selected">Modificar</a></li>
	    		<li><a href="./login/cerrar.php">Salir</a></li>
			</menu>
		</nav>
		<h1>MODIFICAR Y/O ELIMINAR</h1>
		<!-- tabla para modificar los datos de los productos ofrecidos a los clientes -->
		<table width="100%">
			<tr>
				<td>Id</td>
				<td>Nombre</td>
				<td>Descripcion</td>
				<td>Precio</td>
				<td>Eliminar</td>
				<td>Modificar</td>
			</tr>
		<?php 
		    // seleccionamos a todos los productos
			$resultado=mysqli_query($con,"select * from productos");
			// obtenemos filas de resultados como un array numérico, hasta que estas se terminen
			while($row=mysqli_fetch_array($resultado)){
				// no admitimos cambios en la id ni en la imagen
			    // pasamos la id como data-atributo, tanto para eliminar o modificar
			    // llenamos la tabla con los valores actuales de la base de datos
				// tenemos un script escuchando al botón modificar, cuando modificamos un input y apretamos el botón, este se acciona modificando la base de datos
				echo '
				<tr>
					<td>
						<input type="hidden" value="'.$row[0].'">'.$row[0].'
						<input type="hidden" class="imagen" value="'.$row[3].'">
					</td>
					<td><input type="text" class="nombre" value="'.$row[1].'"></td>
					<td><input type="text" class="descripcion" value="'.$row[2].'"></td>
					<td><input type="text" class="precio" value="'.$row[4].'"></td>
					<td><button class="eliminar" data-id="'.$row[0].'">Eliminar</button></td>
					<td><button class="modificar" data-id="'.$row[0].'">Modificar</button></td>
				</tr>
				';
			}
		?>
	</table>
	</section>
</body>
</html>