<?php
/**
* This file contains php functions which get, delete and alter data in db. 
*/


/** 
get all data in json of the tutor with id $id.
$con is the connecction to db 
**/
function getMyData($con, $id){
	$query = "select * FROM tutor WHERE id_tutor = '$id'";
	$data = $con -> fetchAll($query);
	return $data;
}

function get_all_tutors_name($con){
	$query = "select nombre_tutor FROM tutor";
	$data = $con -> fetchAll($query);
	return $data;
}

function get_all_sensors($con, $user_id){
	$query = "select * FROM sensoractuador WHERE id_sen NOT IN (select S.id_sen FROM sensoractuador S INNER JOIN sensor_usuario R ON S.id_sen = R.id_sensor WHERE R.id_usuario= $user_id)";
	$data = $con -> fetchAll($query);
	return $data;
}
function get_link_sensors($con, $user_id){
	$query = "select * FROM sensoractuador S INNER JOIN sensor_usuario R ON S.id_sen = R.id_sensor WHERE R.id_usuario= $user_id";
	$data = $con -> fetchAll($query);
	return $data;
}

function get_all_rooms($con){
	$query = "select * FROM habitacion";
	$data = $con -> fetchAll($query);
	return $data;
}

function get_my_users($con, $id){ 
	$query = "select id_usuario FROM tutor_usuario WHERE id_tutor = '$id'";
	$data = $con -> fetchAll($query);
	return $data;
}

function get_user_data($con, $user_id) { 
	$query = "select * from usuario where id_usuario = '$user_id'";
	$data = $con -> fetchAll($query);
	return $data[0];
}

function get_my_devices($con, $user_id) {
	$query = "select q1.nombre_dispositivo, q1.mac_dispositivo, q1.uDefecto_dispositivo from (select nombre_dispositivo,id_tutor,mac_dispositivo,uDefecto_dispositivo from tutor_dispositivo inner join dispositivo on tutor_dispositivo.id_dispositivo = dispositivo.id_dispositivo) q1 where id_tutor = '$user_id'";
	$data = $con -> fetchAll($query);
	return $data;
}

/**
	get all devices linked to the user with id $user_id
	return array of integers with the ids of the devices	
**/
function get_user_devices($con, $user_id){
	$query = "select id_dispositivo from dispositivo_usuario where id_usuario = $user_id";
	$data = $con -> fetchAll($query);
	//$data = array(1,2);
	$ids = array();
	foreach($data as  $device){
		array_push($ids,intval($device["id_dispositivo"]));
	}
	
	return  $ids ;
}

/**
	get all data, in json, of the device specified by $devices_id 
**/
function get_device_data($con,$device_id){
	$query = "select * from dispositivo where id_dispositivo=$device_id";
	$data = $con -> fetchAll($query);
	return json_encode($data);
}

/**
	get all data, in json, of the devices setted by $devices_id 
**/
function get_devices_data($con, $devices_id){
	$data = array();
	foreach($devices_id as $id){ 
		array_push($data,get_device_data($con, $id));
	}
	return $data;
}

function get_device_name($con, $device_id, $tutor_id){
	$query = "select nombre_dispositivo from tutor_dispositivo where id_dispositivo=$device_id and id_tutor=$tutor_id";
	$data = $con -> fetchAll($query);
	return $data[0]["nombre_dispositivo"];
}

function insert_device($con, $device_mac, $device_uDefault){
	$out = "unknow error";
	
	//MAC MUST BE NOT NULL OR EMPTY
	if($device_mac==""){
		$out = "MAC IS NOT DEFINED OR IS EMPTY";
		return $out;
	}
	
	//MAC MUST BE UNIQUE
	$query = "select mac_dispositivo from dispositivo where mac_dispositivo='$device_mac'";
	$data = $con -> fetchAll($query);
	if(count($data)) {
		$out = "MAC ALREADY EXITS";
		return $out;
	}
	
	//if an uDefault is set, uDefault must exist in the db
	if($device_uDefault!=""){
		$query = "select id_usuario from usuario where id_usuario='$device_uDefault'";
		$data = $con -> fetchAll($query);
		if(count($data)==0) {
			$out = "User with id '$device_uDefault' does not exist";
			return $out;
		}
	}
	
	$out = $con ->insert('dispositivo', array('mac_dispositivo' => $device_mac,'uDefecto_dispositivo' => $device_uDefault));
	if($out == 1) { //succes inserting device, return id of the new device
		$query = "select * from dispositivo where mac_dispositivo='$device_mac'";
		$data = $con -> fetchAll($query);
		$out = json_encode($data);

		//$query = "select * FROM tutor WHERE id_tutor = '$id'";
		//$data = $con -> fetchAll($query);
		//$out = count($data);
	}
	return $out;
}

function link_device_tutor($con,$tutor_id,$id_dispositivo,$nombre_dispositivo){
	$out = "UNKNOW ERROR";
	
	//$tutor_id must be not null and must exist in db
	
	//$id_dispositivo must be not null and must exist in db
	if($id_dispositivo==""){
		$out = "id_dispositivo must be not null";
		return $out;
	}
	else {
		$query = "select id_dispositivo from dispositivo where id_dispositivo='$id_dispositivo'";
		$data = $con -> fetchAll($query);
		if(count($data)==0) {
			$out = "User with id '$device_uDefault' does not exist";
			return $out;
		}	
	}
	
	//$nombre_dispositivo must be not null
	if($nombre_dispositivo=="") {
		$out = "nombre_dispositivo must be not null";
		return $out;
	}
	
	//Pair $tutor_id,$id_dispositivo must be unique
	$query = "select id_tutor_dispositivo from tutor_dispositivo where id_tutor='$tutor_id' and id_dispositivo='$id_dispositivo'";
	$data = $con -> fetchAll($query);
	if(count($data)) {
		$out = "The device $id_dispositivo is already linked with the tutor $tutor_id";
		return $out;
	}

	//Pair $tutor_id,$nombre_dispositivo must be unique
	$query = "select id_tutor_dispositivo from tutor_dispositivo where id_tutor='$tutor_id' and nombre_dispositivo='$nombre_dispositivo'";
	$data = $con -> fetchAll($query);
	if(count($data)) {
		$out = "The tutor $tutor_id already has a device named $nombre_dispositivo";
		return $out;
	}
	
	$out = $con ->insert('tutor_dispositivo', array('id_tutor' => $tutor_id,'id_dispositivo' => $id_dispositivo, 'nombre_dispositivo' =>  $nombre_dispositivo));
	if($out == 1) {
		//$out = "Device $id_dispositivo was linked to tutor $tutor_id and was named: $nombre_dispositivo";
		$query = "select * from tutor_dispositivo where id_dispositivo='$id_dispositivo'";
		$data = $con -> fetchAll($query);
		$out = json_encode($data);
	}
	
	return $out;
}

function link_device_user($con,$id_dispositivo,$id_usuario){
	$out="";
	
	//$id_dispositivo must be defined in table dispostivo ¡TODO

	//$id_usuario must be defined in table dispostivo ¡TODO
	
	//pair ($id_dispositivo,$id_usuario) is unique
	$query = "select * from dispositivo_usuario where id_usuario='$id_usuario' and id_dispositivo='$id_dispositivo'";
	$data = $con -> fetchAll($query);
	if(count($data)) {
		return "The device $id_dispositivo is already linked with the user $id_usuario";
	}	
	
	$out = $con ->insert('dispositivo_usuario', array('id_usuario' => $id_usuario,'id_dispositivo' => $id_dispositivo));
	if($out == 1) {
		//$out = "Device $id_dispositivo was linked to tutor $tutor_id and was named: $nombre_dispositivo";
		$query = "select * from dispositivo_usuario where id_dispositivo='$id_dispositivo' and id_usuario='$id_usuario'";
		$data = $con -> fetchAll($query);
		$out = json_encode($data);
	}	
	else {
		trigger_error("error at link_device_user");
	}
	
	
	return $out;
}

function link_defualtUser_device($con,$id_dispositivo,$uDefault){
	//device with $id_dispositivo should exists
	if(!exists($con,"dispositivo","id_dispositivo",$id_dispositivo)) {
		trigger_error("El dispostivo con id $id_dispositivo no existe");
	}
	
	//user with id $uDefault should exists
	if(!exists($con,"usuario","id_usuario",$uDefault)) {
		trigger_error("El usuario con id $uDefault no existe");
	}
	
	$con->update('dispositivo', array(
		'uDefecto_dispositivo'=>$uDefault), array('id_dispositivo'=>$id_dispositivo
	));
}

function get_my_sensor($con) {
	//$query = "select q1.codigo_sensor, q1.nombre_sensor, q1.senact_sensor, q1.tipo_sensor, q1.modelo_sensor, q1.descripcion_sensor from (select codigo_sensor, nombre_sensor, senact_sensor, tipo_sensor, modelo_sensor, descripcion_sensor from sensor)";
	//$query = "select codigo_sensor, nombre_sensor, senact_sensor, tipo_sensor, modelo_sensor, descripcion_sensor from sensor";
	$query = "select * from sensoractuador where id_habitacion IS NULL";
	$data = $con -> fetchAll($query);
	return $data;
}

	///$query = "select q1.codigo_sensor, q1.nombre_sensor, q1.senact_sensor, q1.tipo_sensor, q1.modelo_sensor, q1.descripcion_sensor from (select codigo_sensor, nombre_sensor, senact_sensor, tipo_sensor, modelo_sensor, descripcion_sensor from sensor)";

function get_my_sensor_bedroom($con, $id_habitacion) {
	//$query = "select q1.codigo_sensor, q1.nombre_sensor, q1.senact_sensor, q1.tipo_sensor, q1.modelo_sensor, q1.descripcion_sensor from (select codigo_sensor, nombre_sensor, senact_sensor, tipo_sensor, modelo_sensor, descripcion_sensor from sensor)";
	//$query = "select codigo_sensor, nombre_sensor, senact_sensor, tipo_sensor, modelo_sensor, descripcion_sensor from sensor";
	$query = "select * from sensoractuador where id_habitacion = $id_habitacion";
	$data = $con -> fetchAll($query);
	return $data;
}

function link_user_sensor($con, $idUser, $idSensor){
	if(!exists($con,"sensoractuador","id_sen",$idSensor)) {
		trigger_error("El sensor con id $idSensor no existe");
	}
	if(!exists($con,"usuario","id_usuario",$idUser)) {
		trigger_error("El usuario con id $idUser no existe");
	}
	
	$out = $con ->insert('sensor_usuario', array('id_sensor' => $idSensor,'id_usuario' => $idUser));
	return $out;
}

function link_user_sensors($con, $idUser, $arr_idSensor){

	foreach($arr_idSensor as $idSensor){
		link_user_sensor($con, $idUser, $idSensor);
	}
}

function exists($con, $tableName, $colName, $colVal) {
	$query = "select * from $tableName where $colName = $colVal";
	$data = $con -> fetchAll($query);
	if(count($data)) {
		return true;
	}
	else {
		return false;
	}
}