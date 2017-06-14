<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
session_start();
mysql_connect("localhost","root","masterkey");
mysql_select_db("bomb");
$data = file_get_contents("php://input");
$dataJsonDecode = json_decode($data);

if($_SESSION['users_login'] == ""){
	$results = '{"results":"Please Login"}';
	echo $results;
}
else{
	$users_id = $dataJsonDecode->var_id;
	$users_login = $dataJsonDecode->var_users_login;
	$users_pass = $dataJsonDecode->var_pass;
	$title = $dataJsonDecode->var_title;
	$names = $dataJsonDecode->var_names;
	$surname = $dataJsonDecode->var_surname;
	$sex = $dataJsonDecode->var_sex;
	$phone = $dataJsonDecode->var_phone;
	$email = $dataJsonDecode->var_email;
	$note = $dataJsonDecode->var_note;
	$last_login = $dataJsonDecode->var_last_login;
	$sql = "UPDATE users SET users_login = '".trim($users_login)."' , users_pass = '".trim($users_pass)."' , title = '".trim($title)."' , names = '".trim($names)."' , surname = '".trim($surname)."' , sex = '".trim($sex)."' , phone_number = '".trim($phone)."' , email = '".trim($email)."' , note = '".trim($note)."'";
	$query = mysql_query($sql);
	$results = '{"results":"complete"}';
}

?>