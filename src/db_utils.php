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

function link_device_Tutor($con,$tutor_id,$id_dispositivo,$nombre_dispositivo){
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

function get_my_sensor($con) {
	//$query = "select q1.codigo_sensor, q1.nombre_sensor, q1.senact_sensor, q1.tipo_sensor, q1.modelo_sensor, q1.descripcion_sensor from (select codigo_sensor, nombre_sensor, senact_sensor, tipo_sensor, modelo_sensor, descripcion_sensor from sensor)";
	//$query = "select codigo_sensor, nombre_sensor, senact_sensor, tipo_sensor, modelo_sensor, descripcion_sensor from sensor";
	$query = "select * from sensor";
	$data = $con -> fetchAll($query);
	return $data;
}
