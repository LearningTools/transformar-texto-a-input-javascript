/********Definimos variables globales*******/

/******** Evento que se ejecuta cuando la pagina ya alla cargado*******/
window.addEventListener("load", function () {
	// Ejecutamos las funciones si existen en el DOM o la pagina por ejemplo

	cargar_datos_lista_ajax();

	//Verificamos que el elemento exita en el dom y se ejecuta el evento submit para ingresar un nuevo departamento
	if (document.querySelector('#agregar_nombre')) {
		document.querySelector('#agregar_nombre').addEventListener('submit', function(e){
			e.preventDefault();
			ingresar_nuevo_nombre_lista();
		}); // end event submit
	}

}); // Cierre del evento load

/************ Mis funciones *************/


function cargar_datos_lista_ajax(){

	var url = javascript_URL + 'ajaxResponse/cargar_informacion_lista_ajax/';
		var parametro = new FormData();
		ajaxAsync("POST", "", "json", url, parametro, function(res){
				//Variable que es donde se va a cargar el contenido de la consulta
				var contenido_resultados = document.querySelector('#ajax_datos_db');
				//se reemplaza la sintaxis HTML del elemento por la respuesta del controlador en el indice de html
				contenido_resultados.innerHTML = res;
				// array de items que tienen todo el contenido de la lista
				var list_content = document.querySelectorAll('.box__body-list--content');
				// Validamos que la variable sea mayor a 1
				if (list_content.length > 0){
					list_content.forEach(function(span){
							// Accedemos al elemento <img> entro del <div class=lbox__body-list--actions>
							span.children[1].children[0].addEventListener('click', function(event){
									var span, input, text;
									// Se obtiene el evento
									event = event || window.event;
									// Se obtiene el elemento seleccionado con su tag y contenido al que se le esta dando click
									span = event.target || event.srcElement;
									// Accedemos al tag <span> que esta entro del elemento <div class="list-item-content-text">
									span_texto = window.event.path[2].children[0].children[0];
									//Obtenemos el texto de la variable span_texto
									text = span_texto.innerHTML;
									// Se crea un elemento de <input>
									input = document.createElement("input");
									// Se le crea el tipo de <input type=text>
									input.type = "text";
									// Se le asigna el value al <input> que tenga la variable text
									input.value = text;
									// Se le asigna al tributo name='nombre' para que lo reciba en el controlador
									input.name = "nombre";
									// Se obtiene el nodo padre del <span> y se insertar el nuevo nodo osea el <input> de la referencia del <span>
									span_texto.parentNode.insertBefore(input,span_texto);
									//llamada de la function que recibe los parametros
									transformar_texto_input(span_texto, input, text);

							});// fin evento click
					}); // fin foreach
				}// fin if
		}); // fin ajaxAsync
}// fin funcion


function transformar_texto_input(span, input, text){

	// Ocultamos el contenido del <span>
	span.style.display = "none";
	// fija el foco del cursor en el elemento del <input>
	input.focus();
	// Evento que se ejecuta cuando pierde el foco en el <input>
	input.addEventListener('blur', function(){
		// Quitamos el <input>
		span.parentNode.removeChild(input);
		// Actualizamos el <span>
		span.innerHTML = input.value == "" ? "&nbsp;" : input.value;
		//Mostramos el contenido nuevo del <span>
		span.style.display = "";
		//console.log(span);
		//Llamamos a la function ajax para que actualice el contenido del input cuando pierda el foco
		actualizar_texto_input_transformado(input.value, span.dataset.resultado);
	});
} // fin funcion


function actualizar_texto_input_transformado(value, id){

	var url = javascript_URL + 'ajaxResponse/actualizar_nombre_lista_ajax';
		var parametro = new FormData();
		parametro.append('nombre', value);
		parametro.append('id', id);
		ajaxAsync("POST", "", "json", url, parametro, function(res){
			if (res == true) {
				Swal.fire({
					type: 'success',
					title: 'Genial...',
					text: 'El nombre fue actualizado con exito!'
				}); // fin alerta
			}// fin if
		}); //end ajaxAsync
} // fin funcion


function ingresar_nuevo_nombre_lista(){

	// Validamos que el campo no este vacio antes de enviar
	var nombre = document.querySelector('#nombre_agregado');
	if (nombre.value == '') {
		Swal.fire({
				type: 'error',
				title: 'Oops...',
				text: 'Parece que no ingreso un nombre!'
		});
			return false;
	} //fin if

	var url = javascript_URL + 'ajaxResponse/insertar_nombre_lista_ajax/';
	var formulario = document.querySelector("#agregar_nombre");
	var parametro = new FormData(formulario);
	ajaxAsync("POST", "", "json", url, parametro, function(res){
		if (res == true) {
				Swal.fire({
					type: 'success',
					title: 'Genial...',
					text: 'El nuevo nombre fue guardado con exito!'
				}).then((result) =>{
						// Reseteamos el formulario
						formulario.reset();
						// Llama a la funcion para que cargue la lista de datos
						cargar_datos_lista_ajax();
					});// end .then
		}//end if

	});//fin ajaxAsync


}


function ajaxAsync(method = "POST", headerType = "", respType = "", url = "", parametros = "", callBack) {
	var xhr = new XMLHttpRequest();

	// abro la conexion
	xhr.open(method, url, true);

	// Send the proper header information along with the request.
	if (headerType === "form")
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	// typo de dato a recibir
	xhr.responseType = respType;

	// evaluo el estado y respuesta
	xhr.onload = function(e) {
		if (xhr.readyState === 4) {
				if (xhr.status === 200) {
						callBack(xhr.response);
				} else {
						return false;
					}
		}
	}; // cierre onload

	// callback para error
	xhr.onerror = function(e) {
		return false;
	};

	// envio de parametros POST
	xhr.send(parametros);
}