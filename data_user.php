<?php

header("Content-Type: application/json; charset=UTF-8");
mysql_connect("localhost","root","masterkey");
mysql_select_db("bomb");
mysql_query( "SET NAMES UTF8" );
$data = file_get_contents("php://input");
$dataJsonDecode = json_decode($data);
$var_id = $dataJsonDecode->var_id;
$sql = "SELECT * FROM users WHERE users_login = '".$var_id."' ";
$resource = mysql_query($sql);
$count_row = mysql_num_rows($resource);

if($count_row > 0) {
	while($result = mysql_fetch_assoc($resource)){
		$rows[]=$result;
	}

	$data = json_encode($rows);
	$totaldata = sizeof($rows);
	$results = '{"results":'.$data.'}';

}else{
	$results = '{"results":null}';
}

echo $results;
?>