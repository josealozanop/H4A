<?php

require_once "serializableObject.php";

class User extends serializableObject{
	protected $id_usuario;
	protected $mail_usuario;
	protected $pass_usuario;
	protected $roles;
	protected $nombre_usuario;
	protected $apellidos_usuario;
	protected $foto_usuario;
	protected $tlfn_usuario;
	protected $fnac_usuario;
	protected $direccion_usuario;
	protected $id_configuracion_usuario;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function getId_usuario(){
		return $this->id_usuario;
	}

	public function setId_usuario($id_usuario){
		$this->id_usuario = $id_usuario;
	}

	public function getMail_usuario(){
		return $this->mail_usuario;
	}

	public function setMail_usuario($mail_usuario){
		$this->mail_usuario = $mail_usuario;
	}

	public function getPass_usuario(){
		return $this->pass_usuario;
	}

	public function setPass_usuario($pass_usuario){
		$this->pass_usuario = $pass_usuario;
	}

	public function getRoles(){
		return $this->roles;
	}

	public function setRoles($roles){
		$this->roles = $roles;
	}

	public function getNombre_usuario(){
		return $this->nombre_usuario;
	}

	public function setNombre_usuario($nombre_usuario){
		$this->nombre_usuario = $nombre_usuario;
	}

	public function getApellidos_usuario(){
		return $this->apellidos_usuario;
	}

	public function setApellidos_usuario($apellidos_usuario){
		$this->apellidos_usuario = $apellidos_usuario;
	}

	public function getFoto_usuario(){
		return $this->foto_usuario;
	}

	public function setFoto_usuario($foto_usuario){
		$this->foto_usuario = $foto_usuario;
	}

	public function getTlfn_usuario(){
		return $this->tlfn_usuario;
	}

	public function setTlfn_usuario($tlfn_usuario){
		$this->tlfn_usuario = $tlfn_usuario;
	}

	public function getFnac_usuario(){
		return $this->fnac_usuario;
	}

	public function setFnac_usuario($fnac_usuario){
		$this->fnac_usuario = $fnac_usuario;
	}

	public function getDireccion_usuario(){
		return $this->direccion_usuario;
	}

	public function setDireccion_usuario($direccion_usuario){
		$this->direccion_usuario = $direccion_usuario;
	}

	public function getId_configuracion_usuario(){
		return $this->id_configuracion_usuario;
	}

	public function setId_configuracion_usuario($id_configuracion_usuario){
		$this->id_configuracion_usuario = $id_configuracion_usuario;
	}
}

?>