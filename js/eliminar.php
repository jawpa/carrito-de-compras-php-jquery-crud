<?php 
  // buscamos el producto coincidente con la id pasada del producto a borrar y lo excluimos de la construcción del nuevo array con el resto de los elementos
  session_start();
  // guardamos los datos de la sesión en un array
  $arreglo = $_SESSION['carrito'];
  // recorremos el carrito buscando la el producto a borrar con la id pasada
  for ($i=0; $i < count($arreglo); $i++) { 
  	    // guardamos los registros que no vamos a borrar en un nuevo array asociativo
  	    if($arreglo[$i]['id'] != $_POST['Id']) { 
  	 	    $datosNuevos[]=array( 
  	 		  'Id'=>$arreglo[$i]['id'], 
  	 		  'Nombre'=>$arreglo[$i]['nombre'], 
  	 		  'Precio'=>$arreglo[$i]['precio'], 
  	 		  'Imagen'=>$arreglo[$i]['imagen'], 
  	 		  'Cantidad'=>$arreglo[$i]['cantidad']); 
  	    } 
  	} 

    // si tiene un contenido ese array lo guardamos en la sesión carrito
    if(isset($datosNuevos)) { 
  		$_SESSION['carrito'] = $datosNuevos; 
      echo "0";
  	// si no tiene contenido destruimos la variable de sesión	
  	// y enviamos un 0 al post	
  	} else { 
  		unset($_SESSION['carrito']); 
  		echo '0'; 
  	}
  }



 ?>