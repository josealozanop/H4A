<?php

require_once "serializableObject.php";

class DeviceLayout extends serializableObject{
	
	protected $id_dispositivo;
	protected $id_usuario;
	protected $rotacion;
	protected $filas_vertical;
	protected $columnas_vertical;
	protected $filas_horizontal;
	protected $columnas_horizontal;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function getid_dispositivo(){
		return $this->id_dispositivo;
	}

	public function setid_dispositivo($id_dispositivo){
		$this->id_dispositivo = $id_dispositivo;
	}
	
	public function getId_usuario(){
		return $this->id_usuario;
	}

	public function setId_usuario($id_usuario){
		$this->id_usuario = $id_usuario;
	}

	public function getRotacion(){
		return $this->rotacion;
	}

	public function setRotacion($rotacion){
		$this->rotacion = $rotacion;
	}

	public function getFilas_vertical(){
		return $this->filas_vertical;
	}

	public function setFilas_vertical($filas_vertical){
		$this->filas_vertical = $filas_vertical;
	}

	public function getColumnas_vertical(){
		return $this->columnas_vertical;
	}

	public function setColumnas_vertical($columnas_vertical){
		$this->columnas_vertical = $columnas_vertical;
	}

	public function getFilas_horizontal(){
		return $this->filas_horizontal;
	}

	public function setFilas_horizontal($filas_horizontal){
		$this->filas_horizontal = $filas_horizontal;
	}

	public function getColumnas_horizantal(){
		return $this->columnas_horizantal;
	}

	public function setColumnas_horizantal($columnas_horizantal){
		$this->columnas_horizantal = $columnas_horizantal;
	}
}

?>