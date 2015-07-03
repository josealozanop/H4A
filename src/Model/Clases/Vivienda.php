<?php
require_once ('Habitacion.php');

namespace Sistema;



use Sistema;
/**
 * @author JoseAntonio
 * @version 1.0
 * @created 03-jul.-2015 10:12:41
 */
class Vivienda
{

	private $id_vivienda;
	private $direccion_vivienda;
	private $localidad_vivienda;
	private $provincia_vivienda;
	private $cp_vivienda;
	private $uso_vivienda;
	public $m_Habitacion;

	function __construct()
	{
	}

	function __destruct()
	{
	}



	public function getId_vivienda()
	{
		return $this->id_vivienda;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setId_vivienda($newVal)
	{
		$this->id_vivienda = $newVal;
	}

	public function getDireccion_vivienda()
	{
		return $this->direccion_vivienda;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDireccion_vivienda($newVal)
	{
		$this->direccion_vivienda = $newVal;
	}

	public function getLocalidad_vivienda()
	{
		return $this->localidad_vivienda;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setLocalidad_vivienda($newVal)
	{
		$this->localidad_vivienda = $newVal;
	}

	public function getProvincia_vivienda()
	{
		return $this->provincia_vivienda;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setProvincia_vivienda($newVal)
	{
		$this->provincia_vivienda = $newVal;
	}

	public function getCp_vivienda()
	{
		return $this->cp_vivienda;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setCp_vivienda($newVal)
	{
		$this->cp_vivienda = $newVal;
	}

	public function getUso_vivienda()
	{
		return $this->uso_vivienda;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setUso_vivienda($newVal)
	{
		$this->uso_vivienda = $newVal;
	}

}
?>