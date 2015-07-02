<?php

class TD{
	public static $configuracion_usuario = array(
		"schema" => array(
			"id_configuracion_usuario",
			"color_principal",
			"color_secundario",
			"contraste",
			"tam_letra",
			"barrido",
			"tiempo_barrido",
			"reconocimiento_voz",
			"retroalimentacion_vibracion",
			"retroalimentacion_voz"
		),
		"id" => "id_configuracion_usuario",
		"name" => "configuracion_usuario"
	);
	
	public static $dispositivo_usuario = array(
		"schema" => array(
			"id_dispositivo_usuario",
			"id_dispositivo",
			"id_usuario",
			"rotacion",
			"filas_vertical",
			"columnas_vertical",
			"filas_horizontal",
			"columnas_horizontal"
		),
		"id" => "id_dispositivo_usuario",
		"name" => "dispositivo_usuario"
	);
	
	public static $usuario = array(
		"schema" => array(
			"id_usuario",
			"mail_usuario",
			"pass_usuario",
			"roles",
			"nombre_usuario",
			"apellidos_usuario",
			"foto_usuario",
			"tlfn_usuario",
			"fnac_usuario",
			"direccion_usuario",
			"id_configuracion_usuario"
		),
		"id" => "id_usuario",
		"name" => "usuario"
	);
	
	public static $dispositivo = array(
		"schema" => array(
			"id_dispositivo",
			"mac_dispositivo",
			"uDefecto_dispositivo"
		),
		"id" => "id_dispositivo",
		"name" => "dispositivo"
	);
	
	public static $sensorActuador = array(
		"schema" => array(
			"id_sen",
			"Id_Sensor",
			"PIN",
			"Tipo",
			"TipoValor",
			"Valor",
			"Localizacion",
			"id_usuario",
			"id_habitacion",
			"codigo_sensor",
			"codigo_sensor",
			"senact_sensor",
			"tipo_sensor",
			"modelo_sensor",
			"descripcion_sensor"			
		),
		"id" => "id_sen",
		"name" => "sensoractuador"
	);
	
	public static $sensor_usuario = array(
		"schema" => array(
			"id_sensor_usuario",
			"id_sensor",
			"id_usuario"
		),
		"id" => "id_sensor_usuario",
		"name" => "sensor_usuario"
	);
	
	public static $habitacion = array(
		"schema" => array(
			"id_habitacion",
			"nombre_habitacion",
			"id_vivienda",
			"tipo_habitacion",
			"id_sensores",
			"id_propietario",
			"id_usuarios",
		),
		"id" => "id_habitacion",
		"name" => "habitacion"
	);
}
?>














