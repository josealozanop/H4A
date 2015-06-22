<?php

require_once "serializableObject.php";

class Config extends serializableObject{
	protected $dificultadCromatica;
	protected $color1;
	protected $color2;
	protected $sistemaBarrido;
	protected $tiempoBarrido;
	protected $contraste;
	protected $tamLetra;
	protected $reconocimientoVoz;
	protected $respuestaPorVoz;
	protected $vibracion;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function getDificultadCromatica(){
		return $this->dificultadCromatica;
	}

	public function setDificultadCromatica($dificultadCromatica){
		$this->dificultadCromatica = $dificultadCromatica;
	}

	public function getColor1(){
		return $this->color1;
	}

	public function setColor1($color1){
		$this->color1 = $color1;
	}

	public function getColor2(){
		return $this->color2;
	}

	public function setColor2($color2){
		$this->color2 = $color2;
	}

	public function getSistemaBarrido(){
		return $this->sistemaBarrido;
	}

	public function setSistemaBarrido($sistemaBarrido){
		$this->sistemaBarrido = $sistemaBarrido;
	}

	public function getTiempoBarrido(){
		return $this->tiempoBarrido;
	}

	public function setTiempoBarrido($tiempoBarrido){
		$this->tiempoBarrido = $tiempoBarrido;
	}

	public function getContraste(){
		return $this->contraste;
	}

	public function setContraste($contraste){
		$this->contraste = $contraste;
	}

	public function getTamLetra(){
		return $this->tamLetra;
	}

	public function setTamLetra($tamLetra){
		$this->tamLetra = $tamLetra;
	}

	public function getReconocimientoVoz(){
		return $this->reconocimientoVoz;
	}

	public function setReconocimientoVoz($reconocimientoVoz){
		$this->reconocimientoVoz = $reconocimientoVoz;
	}

	public function getRespuestaPorVoz(){
		return $this->respuestaPorVoz;
	}

	public function setRespuestaPorVoz($respuestaPorVoz){
		$this->respuestaPorVoz = $respuestaPorVoz;
	}

	public function getVibracion(){
		return $this->vibracion;
	}

	public function setVibracion($vibracion){
		$this->vibracion = $vibracion;
	}
}
?>