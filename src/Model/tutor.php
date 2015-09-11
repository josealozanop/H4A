<?php

require_once "serializableObject.php";

class tutor extends serializableObject{
	protected $id;
	protected $mail;
	protected $pass;
	protected $rol;
	protected $nombre;
	protected $apellidos;
	protected $tlfn;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getMail(){
		return $this->mail;
	}

	public function setMail($mail){
		$this->mail = $mail;
	}

	public function getPass(){
		return $this->pass;
	}

	public function setPass($pass){
		$this->pass = $pass;
	}

	public function getRol(){
		return $this->rol;
	}

	public function setRol($rol){
		$this->rol = $rol;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getApellidos(){
		return $this->apellidos;
	}

	public function setApellidos($apellidos){
		$this->apellidos = $apellidos;
	}

	public function getTlfn(){
		return $this->tlfn;
	}

	public function setTlfn($tlfn){
		$this->tlfn = $tlfn;
	}
}
?>