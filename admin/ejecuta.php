<?php 
	include "../conexion.php";
	// si la variable que recibimos llamada Caso es igual a eliminar:
	if($_POST['Caso']=="Eliminar"){
		// eliminamos ese registro
		mysqli_query($con,"delete from productos where id=".$_POST['Id']);
		// borramos la imagen en el directorio que está almacenada
		unlink("../productos/".$_POST['Imagen']);
		// enviamos un mensaje como respuesta
		echo 'El producto se ha eliminado';
	}
	// si la propiedad Caso que recibimos vía post es igual a modificar: 
	if($_POST['Caso']=="Modificar"){
		// modificamos la base de datos con los otros valores recibidos y enviamos un mensaje
		mysqli_query($con,"update productos set nombre='".$_POST['Nombre']."' where id=".$_POST['Id']);
		mysqli_query($con,"update productos set descripcion='".$_POST['Descripcion']."' where id=".$_POST['Id']);
		mysqli_query($con,"update productos set precio='".$_POST['Precio']."' where id=".$_POST['Id']);
		echo 'El producto se ha modificado';
	}

?>