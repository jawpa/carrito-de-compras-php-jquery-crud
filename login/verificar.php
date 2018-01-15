<?php
session_start();
include "../conexion.php";
// buscamos si el usario y su contraseña ingresado está en la base de datos
echo($_POST['usuario']);
echo($_POST['password']);
$re=mysqli_query($con,"select * from usuarios where usuario='".$_POST['usuario']."' AND 
 					password='".$_POST['password']."'")	or die(mysql_error());
	while ($f=mysqli_fetch_array($re)) {
		// ponemos los datos en un arreglo
		$arreglo[]=array('Nombre'=>$f['nombre'],
			'Apellido'=>$f['apellido'],'Imagen'=>$f['imagen']);
	}
	// si está definido el arreglo, lo ponemos una sesión usuario
	// vamos a admin.php
	if(isset($arreglo)){
		$_SESSION['Usuario'] = $arreglo;

		header("Location: ../admin.php");
	}else{
		// sino nos deriva con un error a la página de login
		header("Location: ../login.php?error=datos no validos");
	}


?>