<?php
require_once ('..\config.php');
require_once ('Dispositivo.php');
require_once ('Tutor.php');
require_once ('SensorActuador.php');

namespace Sistema;



use Sistema;
use Sistema;
use Sistema;
use Sistema;
/**
 * @author JoseAntonio
 * @version 1.0
 * @created 03-jul.-2015 10:13:31
 */
class Usuario
{

	private $id_usuario;
	private $mail_usuario;
	private $pass_usuario;
	private $roles;
	private $nombre_usuario;
	private $foto_usuario;
	private $tlfn_usuario;
	private $fnac_usuario;
	private $direccion_usuario;
	public $m_Config;
	public $m_Dispositivo;
	public $m_Tutor;
	public $m_SensorActuador;

	function __construct()
	{
	}

	function __destruct()
	{
	}



	public function getDireccion_usuario()
	{
		return $this->direccion_usuario;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDireccion_usuario(char $newVal)
	{
		$this->direccion_usuario = $newVal;
	}

	public function getFnac_usuario()
	{
		return $this->fnac_usuario;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setFnac_usuario($newVal)
	{
		$this->fnac_usuario = $newVal;
	}

	public function getTlfn_usuario()
	{
		return $this->tlfn_usuario;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setTlfn_usuario($newVal)
	{
		$this->tlfn_usuario = $newVal;
	}

	public function getFoto_usuario()
	{
		return $this->foto_usuario;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setFoto_usuario($newVal)
	{
		$this->foto_usuario = $newVal;
	}

	public function getNombre_usuario()
	{
		return $this->nombre_usuario;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setNombre_usuario($newVal)
	{
		$this->nombre_usuario = $newVal;
	}

	public function getRoles()
	{
		return $this->roles;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setRoles($newVal)
	{
		$this->roles = $newVal;
	}

	public function getPass_usuario()
	{
		return $this->pass_usuario;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPass_usuario($newVal)
	{
		$this->pass_usuario = $newVal;
	}

	public function getMail_usuario()
	{
		return $this->mail_usuario;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setMail_usuario(char $newVal)
	{
		$this->mail_usuario = $newVal;
	}

	public function getId_usuario()
	{
		return $this->id_usuario;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setId_usuario(int $newVal)
	{
		$this->id_usuario = $newVal;
	}

}
?>