<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
mysql_connect("localhost","root","masterkey");
mysql_select_db("prison");
$data = file_get_contents("php://input");
$dataJsonDecode = json_decode($data);

$id = $dataJsonDecode->var_id;
$pass = $dataJsonDecode->var_pass;

$sql = "SELECT * FROM visitor WHERE personal_id = '".($id)."' and password = '".md5($pass)."'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query);

if(!$result){
	$results = '{"results":"not match"}';
}
else{
		$results = '{"results":"match"}';
}
echo $results;
?>