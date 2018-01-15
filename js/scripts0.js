// var inicio = function () {
// 	alert('');
// }

$(document).ready(function() { 
     // listener keyup al campo de texto con clase cantidad
     // escuchamos al evento del teclado que deja de tocar una tecla
	$(".cantidad").keyup(function(e){
		// validamos que el campo no esté vacío
		if($(this).val()!=''){
			// cuando el objeto evento tenga valor 13 (soltar la tecla enter)
			if(e.keyCode==13){
				// capturo los data-atributos del input cantidad
				var id=$(this).attr('data-id');
				var precio=$(this).attr('data-precio');
				// obtenemos el valor del input
				var cantidad=$(this).val();
				// le cambiamos dinámicamente el contenido al cajón con la clase subtotal
				// buscamos vía dom: escalamos a la clase padre producto
				// luego buscamos el nodo con la clase subtotal y le modificamos el texto
				$(this).parentsUntil('.producto').find('.subtotal').text('Subtotal: '+(precio*cantidad));
				// método post de ajax
				// trabajamos con el archiv modificardatos.php
				$.post('./js/modificardatos.php',{
					// le enviamos parámetros con las variables capturadas y el valor cantidad
					Id:id,
					Precio:precio,
					Cantidad:cantidad
					// una función recibe un objeto evento (el echo enviado)
					// capturamos el valor enviado y lo escribimos en la caja con la id total
				},function(e){
						$("#total").text('Total: '+e);
				});
			}
		}
	});
 
    $(".eliminar").click(function (e) {
		// prevenimos el comportamiento habitual del enlace, la recarga de la página
		e.preventDefault();
		// capturamos el atributo data-id
		var id = $(this).attr('data-id');
        // quitamos al nodo padre que tenga la clase producto, quitamos el producto 
        // de la vista del público 
        // escalamos hasta la clase padre producto y lo quitamos
        $(this).parentsUntil('.producto').remove(); 
        // lo removemos del array con el método post de ajax 
        // le enviamos el id del producto a borrar del array al archivo eliminar.php
        $.post('./js/eliminar.php', {   
             Id: id 
            // recibimos una función para rescatar el valor enviado por eliminar.php
            // si es cero, el carrito está vacío, la sesión está vacía y vamos a carritodecompras.php 
        }, function(a) {  
            if(a=='0'){         
                location.href = "./carritodecompras.php";         
            }
        });﻿    

    });﻿
 
 });﻿



