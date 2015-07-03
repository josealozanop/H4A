<?php
require_once ('..\..\..\..\..\..\Users\JoseAntonio\Desktop\Dispositivo.php');

namespace Sistema;



use Sistema;
/**
 * @author JoseAntonio
 * @version 1.0
 * @created 03-jul.-2015 10:10:56
 */
class Tutor
{

	private $id_tutor;
	private $mail_tutor;
	private $pass_tutor;
	private $roles;
	private $nombre_tutor;
	private $apellidos_tutor;
	private $tlfn_tutor;
	public $m_Dispositivo;

	function __construct()
	{
	}

	function __destruct()
	{
	}



	public function getId_tutor()
	{
		return $this->id_tutor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setId_tutor($newVal)
	{
		$this->id_tutor = $newVal;
	}

	public function getMail_tutor()
	{
		return $this->mail_tutor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setMail_tutor($newVal)
	{
		$this->mail_tutor = $newVal;
	}

	public function getPass_tutor()
	{
		return $this->pass_tutor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPass_tutor($newVal)
	{
		$this->pass_tutor = $newVal;
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

	public function getNombre_tutor()
	{
		return $this->nombre_tutor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setNombre_tutor($newVal)
	{
		$this->nombre_tutor = $newVal;
	}

	public function getApellidos_tutor()
	{
		return $this->apellidos_tutor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setApellidos_tutor($newVal)
	{
		$this->apellidos_tutor = $newVal;
	}

	public function getTlfn_tutor()
	{
		return $this->tlfn_tutor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setTlfn_tutor($newVal)
	{
		$this->tlfn_tutor = $newVal;
	}

}
?>