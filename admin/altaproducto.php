<?php
    // recibe los datos del formulario agregarproducto.php
	// y los ingresa a la base de datos
    // la subida de la imagen es verificada

	// incluimos la conexión
	include ("../conexion.php");

	// verificamos si están definidos los datos del formulario
	if(!isset($_POST['nombre']) &&  !isset($_POST['descripcion']) && !isset($_POST['precio'])){
		header("Location: agregarproducto.php");
	}else{
            // configuramos variables para comprobar el formato de las imágenes
			$allowedExts = array("gif", "jpeg", "jpg", "png"); // extensiones permitidas
			$temp = explode(".", $_FILES["file"]["name"]);  // la ruta del imagen en el archivo temporal
			$extension = end($temp); // extraigo la extensíón del archivo temporal
			$imagen="";   // variable para guardar el nombre de la imagen del archivo temporal
			$random=rand(1,999999); // variable aleatoria por si dos imágenes se llaman del mismo modo

			// verificamos la extensión/el formato del archivo que queremos subir
			if ((($_FILES["file"]["type"] == "image/gif")
				|| ($_FILES["file"]["type"] == "image/jpeg")
				|| ($_FILES["file"]["type"] == "image/jpg")
				|| ($_FILES["file"]["type"] == "image/pjpeg")
				|| ($_FILES["file"]["type"] == "image/x-png")
				|| ($_FILES["file"]["type"] == "image/png"))){
				// Verificamos si se subió bien el archivo
		  	    if ($_FILES["file"]["error"] > 0){
		  		  // escribimos el tipo de error
		    	   echo "Error numero: " . $_FILES["file"]["error"] . "<br>";
		        }else{
		        // si no hay errores, guardamos a la imagen con el random adelante
                    $imagen= $random.'_'.$_FILES["file"]["name"];
		    	    // verificamos que no exista un nombre igual en la carpeta de destino
		    	    if(file_exists("../productos/".$random.'_'.$_FILES["file"]["name"])){
		      		    echo $_FILES["file"]["name"] . " Ya existe. ";
		      	    }else{
		      	    	// movemos la imagen desde el archivo temporal al archivo de destino
		      		   move_uploaded_file($_FILES["file"]["tmp_name"],
		      		   "../productos/" .$random.'_'.$_FILES["file"]["name"]);
		      		   // mostramos un mensaje de éxito
		      		   echo "Archivo guardado en " . "../productos/" .$random.'_'. $_FILES["file"]["name"];

		      		   // guardamos en variables los otros datos recibidos
		      		   $producto=$_POST['nombre'];
					   $descripcion=$_POST['descripcion'];
					   $precio=$_POST['precio'];
					   // escribimos la sentencia sql de insersión a la base de datos de productos
					   $Sql="insert into productos (nombre,descripcion,imagen,precio) values(
							'".$producto."',
							'".$descripcion."',
							'".$imagen."',
							'".$precio."')";
                        // ejecutamos la sentencia
					    mysqli_query($con,$Sql);
					    // volvemos al menú de agregar productos
					    header ("Location: agregarproducto.php");
		            }
		        }
		    }else{
		       echo "Formato no soportado";
		    }

		
	}
?>
