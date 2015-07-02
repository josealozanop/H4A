<?php

require_once "serializableObject.php";

class sensorActuador extends serializableObject{
	protected $id_sen;
	
	protected $Id_Sensor;
	protected $PIN;
	protected $Tipo;
	protected $TipoValor;
	protected $Valor;
	protected $Localizacion;
	
	protected $id_usuario;
	protected $id_habitacion;
	protected $codigo_sensor;
	protected $nombre_sensor;
	protected $senact_sensor;
	protected $tipo_sensor;
	protected $modelo_sensor;
	protected $descripcion_sensor;
	
		public function getId_sen(){
		return $this->id_sen;
	}

	public function setId_sen($id_sen){
		$this->id_sen = $id_sen;
	}

	public function getId_Sensor(){
		return $this->Id_Sensor;
	}

	public function setId_Sensor($Id_Sensor){
		$this->Id_Sensor = $Id_Sensor;
	}

	public function getPIN(){
		return $this->PIN;
	}

	public function setPIN($PIN){
		$this->PIN = $PIN;
	}

	public function getTipo(){
		return $this->Tipo;
	}

	public function setTipo($Tipo){
		$this->Tipo = $Tipo;
	}

	public function getTipoValor(){
		return $this->TipoValor;
	}

	public function setTipoValor($TipoValor){
		$this->TipoValor = $TipoValor;
	}

	public function getValor(){
		return $this->Valor;
	}

	public function setValor($Valor){
		$this->Valor = $Valor;
	}

	public function getLocalizacion(){
		return $this->Localizacion;
	}

	public function setLocalizacion($Localizacion){
		$this->Localizacion = $Localizacion;
	}

	public function getId_usuario(){
		return $this->id_usuario;
	}

	public function setId_usuario($id_usuario){
		$this->id_usuario = $id_usuario;
	}

	public function getId_habitacion(){
		return $this->id_habitacion;
	}

	public function setId_habitacion($id_habitacion){
		$this->id_habitacion = $id_habitacion;
	}

	public function getCodigo_sensor(){
		return $this->codigo_sensor;
	}

	public function setCodigo_sensor($codigo_sensor){
		$this->codigo_sensor = $codigo_sensor;
	}

	public function getNombre_sensor(){
		return $this->nombre_sensor;
	}

	public function setNombre_sensor($nombre_sensor){
		$this->nombre_sensor = $nombre_sensor;
	}

	public function getSenact_sensor(){
		return $this->senact_sensor;
	}

	public function setSenact_sensor($senact_sensor){
		$this->senact_sensor = $senact_sensor;
	}

	public function getTipo_sensor(){
		return $this->tipo_sensor;
	}

	public function setTipo_sensor($tipo_sensor){
		$this->tipo_sensor = $tipo_sensor;
	}

	public function getModelo_sensor(){
		return $this->modelo_sensor;
	}

	public function setModelo_sensor($modelo_sensor){
		$this->modelo_sensor = $modelo_sensor;
	}

	public function getDescripcion_sensor(){
		return $this->descripcion_sensor;
	}

	public function setDescripcion_sensor($descripcion_sensor){
		$this->descripcion_sensor = $descripcion_sensor;
	}
	
}

?>