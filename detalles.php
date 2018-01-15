<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title>Carrito de Compras</title>
	<link rel="stylesheet" type="text/css" href="./css/estilos.css">
	<script type="text/javascript"  src="./js/scripts0.js"></script>
</head>
<body>
	<header>
		<h1>Detalles</h1>
		<!-- el path siempre parte de index.php -->
		<a href="./carritodecompras.php" title="ver carrito de compras">
			<img src="./imagenes/carrito.png">
		</a>
	</header>
	<section>
		
	<?php
		include 'conexion.php';
		//tomamos la id del enlace del index
		$id = $_GET['id'];
		$resultado = mysqli_query($con,"select * from productos where id=".$id)or die(mysqli_error());
		while ($f = mysqli_fetch_array($resultado)) {
		?>
         
			<center>
			     <!-- mostramos el registro indicado -->
				<img src="./productos/<?php echo $f['imagen'];?>"><br>
				<span><h1><?php echo $f['nombre'];?></h1></span><br>
				<span><h1>Precio:<?php echo $f['precio'];?></h1></span><br>
				<!-- volvemos a la página principal -->
				<!-- redundante, poniendo "./" produce lo mismo -->
				<a href="./index.php">Volver al Catálogo</a>
				<br>
				<!-- pasamos la id del producto al carrito -->
				<a href="./carritodecompras.php?id=<?php echo $f['id'] ?>">Añadir al carrito de compras</a>
			</center>
		
	<?php
		}
	?>
		
		

		
	</section>
</body>
</html>