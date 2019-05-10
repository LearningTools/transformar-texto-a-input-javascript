<?php
namespace Mini\Model;

use Mini\Core\Model;
// Para hacer uso del la clase helper hacemos uso del namespace, si si va usar en otro modelo debes comentar el que no estes usando y llamarlo en el otro modelo
use Mini\Libs\Helper;
// Tambien tendremos que incluir el archivo
include_once APP . 'Libs/helper.php';

class TransformarTextoModel extends Model
{


	function obtener_todos_nombres_persona()
	{
		$sql = "SELECT id, nombre_persona FROM persona";
		$stmt = $this->db->prepare($sql);
		//echo'[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parametros);  exit();
		try {
			$stmt->execute();
			return $stmt->fetchAll();
		} catch (\Exception $e) {
				return $e->getCode();
			}
	}// fin metodo


	function actualizar_nombre_persona($datos)
	{
		$sql = "UPDATE persona SET nombre_persona = :nombre WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$parametros = array(':nombre' => $datos['nombre'], ':id' => $datos['id']);
		//echo'[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parametros);  exit();
		try {
			$stmt->execute($parametros);
			if ($stmt->rowCount() == 1) {
				return true;
			} else{
					return false;
				}
		} catch (\Exception $e) {
				return $e->getCode();
			}
	}// fin metodo


	function insertar_nombre_persona($datos)
	{
		$sql = "INSERT INTO persona (nombre_persona) VALUES (:nombre)";
		$stmt = $this->db->prepare($sql);
		$parametros = array(':nombre' =>$datos['nombre_nuevo']);
		//echo'[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parametros);  exit();

		try {
			$stmt->execute($parametros);
			if ($stmt->rowCount() == 1) {
					return true;
			} else{
					return false;
				}

		} catch (\Exception $e) {
			
		}
	}


}//fin clase