<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
mysql_connect("localhost","root","masterkey");
mysql_select_db("prison");
$data = file_get_contents("php://input");
$dataJsonDecode = json_decode($data);

$var_id = $dataJsonDecode->var_id;
$var_email = $dataJsonDecode->var_email;
$var_phone = $dataJsonDecode->var_phone;
$var_pass = $dataJsonDecode->var_pass;

$sql = "SELECT * FROM relative WHERE id_number = '".mysql_real_escape_string($var_id)."' and email = '".mysql_real_escape_string($var_email)."' and phone = '".mysql_real_escape_string($var_phone)."'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query);

$resource = mysql_query($sql);
$count_row = mysql_num_rows($resource);

if(!$result){
	$results = '{"results":"not match"}';
}
else{
	$active = "UPDATE relative SET pass = '".md5(mysql_real_escape_string($var_pass))."' WHERE id_number = '".mysql_real_escape_string($var_id)."' ";
	$results = '{"results":"match"}';
}
?>
<!-- //not successs -->