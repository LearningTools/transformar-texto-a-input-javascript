<!DOCTYPE html>
<html lang="es">
<head>
	<!--permiten al navegador mostrar las páginas web que no cumplen con los estándares como si corrieran en versiones anteriores de IE-->
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!--para especificar el color de la barra de dirreciones del navegador movil-->
	<meta name="theme-color" content="">
	<meta name="MobileOptimized" content="width">
	<meta name="HandheldFriendly" content="true">
	<!--Para conseguir que al abrir la web esta se vea sin ningún marco del navegador en pantalla-->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<!--modificar mínimamente la barra de estado de Apple en la parte superior en tono traslucido-->
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- meta etiquetas para el seo-->
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Cristhian Molina">
	<link rel="stylesheet" type="text/css" href="<?= URL ?>public/css/responsive.css" media="none" onload='if(media!="all")media="all"'>
	<link rel="stylesheet" type="text/css" href="<?= URL ?>public/css/estilos.css" media="none" onload='if(media!="all")media="all"'>
	<title>Transformar texto a input y actualizar por ajax</title>
</head>
<body>

<div class="contenedor">
	<div class="fila">
		<div class="col-xl-offset-2 col-xl-8">
			<h2>Transformar un elemento span Tag a un input tag, cuando se de click se transforma, cuando se pierda el foco del input se actualizar el valor y tambien se puede insertar todo con ajax</h2>
		</div>
	</div>
	<!-- Aplicando metodologia BEM (Bloque Elemento Modificador)para definir las clases de los elementos -->
	<div class="fila">
		<div class="col-xl-offset-2 col-xl-8 bg">
			<div class="col-xl-offset-3 col-xl-6 bg">
			<div class="box">
				<div class="box__header">
					<h3>Transformar un span a un input y actualizar e inserta su informacion</h3>
				</div>
				<div class="box__body">
					<ul class="box__body-list scroll-ul" id="ajax_datos_db">
					</ul>
				</div>
				<div class="box__footer">
					<form id="agregar_nombre">
						<div class="box__footer--buscador">
							<input type="text" name="nombre_agregado" id="nombre_agregado" placeholder="&nbsp;">
							<div class="box__footer--boton">
								<button type="submit">Agregar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	var javascript_URL = '<?= URL; ?>';
</script>
<script src="<?= URL; ?>public/js/sweetalert.min.js"></script>
<script src="<?= URL . 'public/js/app_transform_input.js?version=' . microtime(); ?> "></script>

</body>
</html>