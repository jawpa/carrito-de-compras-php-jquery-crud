// cuando el documento esté cargado
$(document).ready(function(){
	// escuchamos al botón eliminar
	$(".eliminar").click(function(){
		// guardamos la imagen en una variable: le decimos que vaya a la td padre
		// luego a la tr y que busque la clase imagen y guarde el valor de ese input 
		var imagen=$(this).parent('td').parent('tr').find('.imagen').val();
		// removemos la fila: le decimos que vaya a la etiqueta td,
		// luego a la tr y la elimine 
		$(this).parent('td').parent('tr').remove();
        // le pasamos por el método post parámetros a ejecuta.php: un texto, la id, la imagen
		$.post('./ejecuta.php',{
			Caso:'Eliminar',
			Id:$(this).attr('data-id'),
			Imagen:imagen
			// recibimos una función anónima con un evento (el texto del echo)
 			// y lo mostramos por pantalla
		},function(e){
			alert(e);
		});
		
	});

	// escuchamos al botón modificar
	$(".modificar").click(function(){
		// escalando por el dom hasta la fila, buscamos los distintos valores de los nodos 
		// que tienen diferentes clases y lo almacenamos en variables
		var nombre=$(this).parent('td').parent('tr').find('.nombre').val();
		var descripcion=$(this).parent('td').parent('tr').find('.descripcion').val();
		var precio=$(this).parent('td').parent('tr').find('.precio').val();
		// vía método post enviamos al archivo ejecuta.php, estos valores: 
		$.post('./ejecuta.php',{
			Caso:'Modificar',
			Id:$(this).attr('data-id'),
			Nombre:nombre,
			Descripcion:descripcion,
			Precio:precio
			// recibimos un evento de ejecuta.php, un echo
		},function(e){
			alert(e);  // imprimimos el texto del echo por pantalla
		});
	});
});