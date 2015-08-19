<?php

require_once "serializableObject.php";

class Config extends serializableObject{
	protected $dificultadCromatica;
	protected $color_principal;
	protected $color_secundario;
	protected $barrido;
	protected $tiempo_barrido;
	protected $contraste;
	protected $tam_letra;
	protected $reconocimiento_voz;
	protected $retroalimentacion_voz;
	protected $retroalimentacion_vibracion;
	protected $css;
	protected $ayudaCromatica;
	
	public function __construct(){
		parent::__construct();
	}
	
	public function getDificultadCromatica(){
		return $this->dificultadCromatica;
	}

	public function setDificultadCromatica($dificultadCromatica){
		$this->dificultadCromatica = $dificultadCromatica;
	}

	public function getColor_principal(){
		return $this->color_principal;
	}

	public function setColor_principal($color_principal){
		$this->color_principal = $color_principal;
	}

	public function getColor_secundario(){
		return $this->color_secundario;
	}

	public function setColor_secundario($color_secundario){
		$this->color_secundario = $color_secundario;
	}

	public function getBarrido(){
		return $this->barrido;
	}

	public function setBarrido($barrido){
		$this->barrido = $barrido;
	}

	public function getTiempo_barrido(){
		return $this->tiempo_barrido;
	}

	public function setTiempo_barrido($tiempo_barrido){
		$this->tiempo_barrido = $tiempo_barrido;
	}

	public function getContraste(){
		return $this->contraste;
	}

	public function setContraste($contraste){
		$this->contraste = $contraste;
	}

	public function getTam_letra(){
		return $this->tam_letra;
	}

	public function setTam_letra($tam_letra){
		$this->tam_letra = $tam_letra;
	}

	public function getReconocimiento_voz(){
		return $this->reconocimiento_voz;
	}

	public function setReconocimiento_voz($reconocimiento_voz){
		$this->reconocimiento_voz = $reconocimiento_voz;
	}

	public function getRetroalimentacion_voz(){
		return $this->retroalimentacion_voz;
	}

	public function setRetroalimentacion_voz($retroalimentacion_voz){
		$this->retroalimentacion_voz = $retroalimentacion_voz;
	}

	public function getRetroalimentacion_vibracion(){
		return $this->retroalimentacion_vibracion;
	}

	public function setRetroalimentacion_vibracion($retroalimentacion_vibracion){
		$this->retroalimentacion_vibracion = $retroalimentacion_vibracion;
	}
	
	public function getCss(){
		return $this->css;
	}
	
	public function setCss($css){
		$this->css = $css;
	}

	public function getAyudaCromatica(){
		return $this->ayudaCromatica;
	}
	
	public function setAyudaCromatica($ayudaCromatica){
		$this->ayudaCromatica = $ayudaCromatica;
	}
}
?>