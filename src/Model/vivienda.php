<?php

require_once "serializableObject.php";

class vivienda extends serializableObject{
	protected $id;
	protected $dir;
	protected $localidad;
	protected $provincia;
	protected $cp;
	protected $habitaciones	;
	protected $uso;
	
	public function __construct(){
		parent::__construct();
	}
	
		public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getDir(){
		return $this->dir;
	}

	public function setDir($dir){
		$this->dir = $dir;
	}

	public function getLocalidad(){
		return $this->localidad;
	}

	public function setLocalidad($localidad){
		$this->localidad = $localidad;
	}

	public function getProvincia(){
		return $this->provincia;
	}

	public function setProvincia($provincia){
		$this->provincia = $provincia;
	}

	public function getCp(){
		return $this->cp;
	}

	public function setCp($cp){
		$this->cp = $cp;
	}

	public function getHabitaciones(){
		return $this->habitaciones;
	}

	public function setHabitaciones($habitaciones){
		$this->habitaciones = $habitaciones;
	}

	public function getUso(){
		return $this->uso;
	}

	public function setUso($uso){
		$this->uso = $uso;
	}
	
}
?>