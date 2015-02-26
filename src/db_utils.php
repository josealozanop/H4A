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
	return json_encode($data);
}

function get_all_tutors_name($con){
	$query = "select nombre_tutor FROM tutor";
	$data = $con -> fetchAll($query);
	return json_encode($data);
}