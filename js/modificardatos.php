<?php
session_start();
	// ponemos en una variable los datos de la variable de sesión
	$arreglo = $_SESSION['carrito'];
	$total = 0;
	$numero = 0;
	// recorremos el arreglo con la sesión
	for($i=0;$i<count($arreglo);$i++){
		// si hay coincidencia entre algún objeto y lo enviado por ajax
		if($arreglo[$i]['id'] == $_POST['Id']){
			// identificamos al objeto
			$numero=$i;
		}
	}
	// le cambiamos el atributo cantidad por lo que nos manda ajax
	$arreglo[$numero]['cantidad'] = $_POST['Cantidad'];
	// recorremos el arreglo de nuevo
	for($i=0;$i<count($arreglo);$i++){
		// recalculamos el precio con la nueva cantidad del producto que se actualizó por ajax
		$total= ($arreglo[$i]['precio'] * $arreglo[$i]['cantidad']) + $total;
	}
	// asignamos los cambios a la sesión carrito
	$_SESSION['carrito'] = $arreglo;
	// enviamos el nuevo total a ajax
	echo $total;

?>