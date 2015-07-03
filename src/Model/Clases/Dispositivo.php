<?php


namespace Sistema;


/**
 * @author JoseAntonio
 * @version 1.0
 * @created 03-jul.-2015 10:11:45
 */
class Dispositivo
{

	private $id_dispositivo;
	private $mac_dispositivo;

	function __construct()
	{
	}

	function __destruct()
	{
	}



	public function getId_dispositivo()
	{
		return $this->id_dispositivo;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setId_dispositivo($newVal)
	{
		$this->id_dispositivo = $newVal;
	}

	public function getMac_dispositivo()
	{
		return $this->mac_dispositivo;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setMac_dispositivo($newVal)
	{
		$this->mac_dispositivo = $newVal;
	}

}
?>