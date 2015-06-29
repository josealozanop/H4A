<?php

require_once "serializableObject.php";

class Room extends serializableObject{
	protected $id_habitacion;
	protected $nombre_habitacion;
	protected $id_vivienda;
	protected $tipo_habitacion;
	protected $id_sensores;
	protected $id_propietario;
	protected $id_usuarios;
	
	public function getId_habitacion(){
		return $this->id_habitacion;
	}

	public function setId_habitacion($id_habitacion){
		$this->id_habitacion = $id_habitacion;
	}

	public function getNombre_habitacion(){
		return $this->nombre_habitacion;
	}

	public function setNombre_habitacion($nombre_habitacion){
		$this->nombre_habitacion = $nombre_habitacion;
	}

	public function getId_vivienda(){
		return $this->id_vivienda;
	}

	public function setId_vivienda($id_vivienda){
		$this->id_vivienda = $id_vivienda;
	}

	public function getTipo_habitacion(){
		return $this->tipo_habitacion;
	}

	public function setTipo_habitacion($tipo_habitacion){
		$this->tipo_habitacion = $tipo_habitacion;
	}

	public function getId_sensores(){
		return $this->id_sensores;
	}

	public function setId_sensores($id_sensores){
		$this->id_sensores = $id_sensores;
	}

	public function getId_propietario(){
		return $this->id_propietario;
	}

	public function setId_propietario($id_propietario){
		$this->id_propietario = $id_propietario;
	}

	public function getId_usuarios(){
		return $this->id_usuarios;
	}

	public function setId_usuarios($id_usuarios){
		$this->id_usuarios = $id_usuarios;
	}	
	
}

?>