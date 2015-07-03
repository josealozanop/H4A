<?php
require_once ('SensorActuador.php');

namespace Sistema;



use Sistema;
/**
 * @author JoseAntonio
 * @version 1.0
 * @created 03-jul.-2015 10:12:15
 */
class Habitacion
{

	private $id_habitacion;
	private $nombre_habitacion;
	private $tipo_habitacion;
	public $m_SensorActuador;

	function __construct()
	{
	}

	function __destruct()
	{
	}



	public function getId_habitacion()
	{
		return $this->id_habitacion;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setId_habitacion($newVal)
	{
		$this->id_habitacion = $newVal;
	}

	public function getNombre_habitacion()
	{
		return $this->nombre_habitacion;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setNombre_habitacion($newVal)
	{
		$this->nombre_habitacion = $newVal;
	}

	public function getTipo_habitacion()
	{
		return $this->tipo_habitacion;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setTipo_habitacion($newVal)
	{
		$this->tipo_habitacion = $newVal;
	}

}
?>