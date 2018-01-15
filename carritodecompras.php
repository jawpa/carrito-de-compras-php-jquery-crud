<!-- ponemos la variable de sesión antes de todo -->
<?php 
  session_start();
  include './conexion.php';

  // comprobamos si existe la variable de sesión
  if (isset($_SESSION['carrito'])) {

  	// comprobamos que esté definido el producto ingresado al carrito
  	if (isset($_GET['id'])) {
  		// ponemos lo que hay en la sesión (que es un arreglo de objetos productos) en una variable
	    $arreglo = $_SESSION['carrito'];
	    $encontro = false;     
	    $numero = 0;

	    // recorremos el arreglo buscando si el producto camprado ya estaba en el carrito 
	    for ($i=0; $i < count($arreglo) ; $i++) { 
	    	if ($arreglo[$i]['id'] == $_GET['id']) {
	    		$encontro = true;
	    		// guardamos la posición del producto
	    		$numero = $i;
	    	}
	    }

        // si el producto ya estaba en el carrito, incrementamos la cantidad del mismo
	    if ($encontro) {
	    	$arreglo[$numero]['cantidad']++;
	    	$_SESSION['carrito'] = $arreglo;
	    }
        // si no estaba, lo ponemos en la sesión
        else{
        	  $nombre = "";
       	    $precio = 0;
       	    $imagen = "";
       	    $resultado = mysqli_query($con,"select * from productos where id =". $_GET['id']);
            // guardamos algunos datos del producto en variables
            while($resulset=mysqli_fetch_array($resultado)){
            	$nombre = $resulset['nombre'];
            	$precio = $resulset['precio'];
            	$imagen = $resulset['imagen'];
            }
            // ponemos esas variables como valores de un array asociativo
            // como es la primera vez que entra el producto al carrito el valor de cantidad por defecto es uno 
            $nuevoproducto = array('id'=>$_GET['id'],
            	               'nombre'=>$nombre,
            	               'precio'=>$precio,
            	               'imagen'=>$imagen,
            	               'cantidad'=>1);

            // metemos al objeto producto en el vector
            array_push($arreglo, $nuevoproducto);
            
            // ponemos el arreglo en la sesión 
            $_SESSION['carrito'] = $arreglo;
        }
  	}
	  	 

  	 
  }else{
       // si no existe, comprobamos que recibimos un producto
       if (isset($_GET['id'])) {
       	    $nombre = "";
       	    $precio = 0;
       	    $imagen = "";
       	    $resultado = mysqli_query($con,"select * from productos where id =". $_GET['id']);
            // guardamos algunos datos del resultado en variables
            while($resulset=mysqli_fetch_array($resultado)){
            	$nombre = $resulset['nombre'];
            	$precio = $resulset['precio'];
            	$imagen = $resulset['imagen'];
            }
            // ponemos esas variables como valores de un array de arrays asociativos
            // como es la primera vez que entra (por condición de condicional) el valor de cantidad por defecto es uno 
            $arreglo[] = array('id'=>$_GET['id'],
            	               'nombre'=>$nombre,
            	               'precio'=>$precio,
            	               'imagen'=>$imagen,
            	               'cantidad'=>1);

            // metemos al vector en la sesión
            $_SESSION['carrito'] = $arreglo;
       }

  }

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title>Carrito de Compras</title>
	<!-- las rutas siempre pivotea con index.php -->
	<link rel="stylesheet" type="text/css" href="./css/estilos.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<!-- <script type="text/javascript"  src="./js/scripts.js"></script> -->
	<!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
	<script type="text/javascript"  src="./js/scripts0.js"></script>
</head>
<body>
	<header>
		<h1>Carrito de Compras</h1>
		<a href="./carritodecompras.php" title="ver carrito de compras">
			<img src="./imagenes/carrito.png">
		</a>
	</header>

	<section>
		<?php  

      // presentamos el carrito de compras en la pantalla

            // suma del precio de los productos comprados
            $total = 0;

		    // si está definida la variable de sesión
		    // la variable de sesión trae un arreglo
			if (isset($_SESSION['carrito'])){
                
                $total = 0;
                // guardamos la sesión en un array de objetos productos
                $datos = $_SESSION['carrito'];
                
                for ($i=0; $i < count($datos); $i++) { 
        ?>     
                    <!-- mostramos los productors comprados y sus respectivas cantidades-->
                    <div class="producto">
                   	    <center>
                   	    	<img src="./productos/<?php echo($datos[$i]['imagen']) ?>"><br>
                   	    	<span><?php echo($datos[$i]['nombre']) ?></span><br>
                   	    	<span>Precio:$<?php echo($datos[$i]['precio']) ?></span><br>
                   	    	<span>Cantidad:
                   	    	<!-- ponemos el data-attribute precio e id para jquery-->
                   	    	<!-- ponemos una clase cantidad porque el arreglo puedo traer n registros y va haber n input con el mismo id-->
                   	    	    <input type="text" value="<?php echo($datos[$i]['cantidad'])?>" size='3' data-precio="<?php echo($datos[$i]['precio']) ?>" data-id="<?php echo($datos[$i]['id']) ?>" class="cantidad" >
                   	    	</span><br>
                   	    	<!-- ponemos la clase subtotal -->
                   	    	<span class="subtotal">SubTotal Producto:<?php echo($datos[$i]['cantidad']*$datos[$i]['precio'])?></span>
                          <!-- enviamos al jquery el elemento a eliminar del carrito  -->  
                          <a href="#" class="eliminar" data-id="<?php echo($datos[$i]['id']) ?>">Eliminar</a>
                   	    </center>
                    </div>   	

        <?php    
                    // para cada vuelta de producto, sumamos los precios totales de las unidades compradas
                    $total = $total + $datos[$i]['precio'] * $datos[$i]['cantidad'];    
                }
         
			} // si no está definida la variable de sesión mostramos este mensaje
			else{
				echo "<center><h2>El Carrito de Compras está vacío</h2></center>";
			}
			// calculamos la suma total de todas las unidades de todos los productos
			echo "<center><h2 id='total'>Total Compra:" .$total. "</h2></center><br>";

      // no queremos que el botón comprar aparezca cuando está vacío
      if ($total!=0) {
         echo "<center><a href='./compras/compras.php' class='aceptar'>Comprar</a></center><br>";
      } 
    ?>	
        <!-- volvemos al index -->
        <center><a href="./">Volver al catálogo</a></center>   		
	</section>
	
</body>
</html>