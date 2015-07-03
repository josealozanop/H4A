<?php


namespace Sistema;


/**
 * @author JoseAntonio
 * @version 1.0
 * @created 03-jul.-2015 10:12:27
 */
class SensorActuador
{

	private $id_sensor;
	private $pin_sensor;
	private $tipo_sensor;
	private $tipoValor_sensor;
	private $valor_sensor;
	private $localizacion_sensor;
	private $codigo_sensor;
	private $nombre_sensor;
	private $SenAnct_sensor;
	private $Modelo_sensor;
	private $descripcion_sensor;

	function __construct()
	{
	}

	function __destruct()
	{
	}



	public function getId_sensor()
	{
		return $this->id_sensor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setId_sensor($newVal)
	{
		$this->id_sensor = $newVal;
	}

	public function getPin_sensor()
	{
		return $this->pin_sensor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setPin_sensor($newVal)
	{
		$this->pin_sensor = $newVal;
	}

	public function getTipo_sensor()
	{
		return $this->tipo_sensor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setTipo_sensor($newVal)
	{
		$this->tipo_sensor = $newVal;
	}

	public function getTipoValor_sensor()
	{
		return $this->tipoValor_sensor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setTipoValor_sensor($newVal)
	{
		$this->tipoValor_sensor = $newVal;
	}

	public function getValor_sensor()
	{
		return $this->valor_sensor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setValor_sensor($newVal)
	{
		$this->valor_sensor = $newVal;
	}

	public function getLocalizacion_sensor()
	{
		return $this->localizacion_sensor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setLocalizacion_sensor($newVal)
	{
		$this->localizacion_sensor = $newVal;
	}

	public function getCodigo_sensor()
	{
		return $this->codigo_sensor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setCodigo_sensor($newVal)
	{
		$this->codigo_sensor = $newVal;
	}

	public function getNombre_sensor()
	{
		return $this->nombre_sensor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setNombre_sensor($newVal)
	{
		$this->nombre_sensor = $newVal;
	}

	public function getSenAnct_sensor()
	{
		return $this->SenAnct_sensor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setSenAnct_sensor($newVal)
	{
		$this->SenAnct_sensor = $newVal;
	}

	public function getModelo_sensor()
	{
		return $this->Modelo_sensor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setModelo_sensor($newVal)
	{
		$this->Modelo_sensor = $newVal;
	}

	public function getDescripcion_sensor()
	{
		return $this->descripcion_sensor;
	}

	/**
	 * 
	 * @param newVal
	 */
	public function setDescripcion_sensor($newVal)
	{
		$this->descripcion_sensor = $newVal;
	}

}
?>