<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title>Carrito de Compras</title>
	<!-- las rutas pivotean con index.php -->
	<link rel="stylesheet" type="text/css" href="./css/estilos.css">
	<script type="text/javascript"  src="./js/scripts0.js"></script>
</head>
<body>
	<header>
		<h1>Carrito De Compras</h1>
		<!-- el path siempre toma como pivot index.php -->
		<a href="./carritodecompras.php" title="ver carrito de compras">
			<img src="./imagenes/carrito.png">
		</a>
	</header>
	<section>
		
	<?php
		include 'conexion.php';
		// seleccionamos a todos los registros de la base
		$resultado = mysqli_query($con,"select * from productos")or die(mysqli_error());
		while ($f = mysqli_fetch_array($resultado)) {
		?>
         <div class="producto">
			<center>
			    <!-- mostramos cada registro -->
				<img src="./productos/<?php echo $f['imagen'];?>"><br>
				<span><?php echo $f['nombre'];?></span><br>
				<!-- vamos a la página detalle con un valor en la url -->
				<!-- dicho valor, mostrará un contenido específico -->
				<a href="./detalles.php?id=<?php echo $f['id'] ?>">ver</a>
			</center>
		</div>
	<?php
		}
	?>
		
		

		
	</section>
</body>
</html>