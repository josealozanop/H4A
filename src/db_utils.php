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