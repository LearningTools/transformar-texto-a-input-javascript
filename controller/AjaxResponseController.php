<?php
namespace Mini\Controller;
use Mini\Model\TransformarTextoModel;

class AjaxResponseController
{


	public function cargar_informacion_lista_ajax()
	{
		$model_tranform = new TransformarTextoModel();
		$obtener_datos = $model_tranform->obtener_todos_nombres_persona();
		$html = '';
		foreach ($obtener_datos as $dato):
					$html .='
					<li class="box__body-list--content">
									<div class="box__body-list--text">
										<span data-resultado="'.$dato->id.'">'.$dato->nombre_persona.'</span>
									</div>
									<div class="box__body-list--actions">
										<img src="'. URL .'public/img/icon-actions.svg" class="click-actions">
									</div>
								</li>
					';
		endforeach;

		echo json_encode($html);
	}//fin metodo


	public function actualizar_nombre_lista_ajax()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$data = array('id' => $_POST['id'], 'nombre' => $_POST['nombre']);
				$model_tranform = new TransformarTextoModel();
				$actualizar_nombre = $model_tranform->actualizar_nombre_persona($data);

				if ($actualizar_nombre) {
						echo json_encode($actualizar_nombre);
				}// fin if

		}// fin if
	} // fin metodo


	public function insertar_nombre_lista_ajax()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$model_tranform = new TransformarTextoModel();
				$dato = array('nombre_nuevo' => $_POST['nombre_agregado']);
				$insertar_nombre = $model_tranform->insertar_nombre_persona($dato);

				if ($insertar_nombre) {
						echo json_encode($insertar_nombre);
				}

		}//fin if
	}// fin metodo


}// fin clase