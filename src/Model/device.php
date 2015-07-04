<?php

require_once "serializableObject.php";

class Device extends serializableObject{
	protected $id_dispositivo;
	protected $mac_dispositivo;
	protected $uDefecto_dispositivo;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function getId_dispositivo(){
		return $this->id_dispositivo;
	}

	public function setId_dispositivo($id_dispositivo){
		$this->id_dispositivo = $id_dispositivo;
	}

	public function getMac_dispositivo(){
		return $this->mac_dispositivo;
	}

	public function setMac_dispositivo($mac_dispositivo){
		$this->mac_dispositivo = $mac_dispositivo;
	}

	public function getUDefecto_dispositivo(){
		return $this->uDefecto_dispositivo;
	}

	public function setUDefecto_dispositivo($uDefecto_dispositivo){
		$this->uDefecto_dispositivo = $uDefecto_dispositivo;
	}
}

?>