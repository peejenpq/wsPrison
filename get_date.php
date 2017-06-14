<?php
header('Content-Type: application/json; charset=utf-8');
mysql_connect("localhost","root","masterkey");
mysql_select_db("prison");
mysql_query( "SET NAMES UTF8");

$data = file_get_contents("php://input");
$dataJsonDecode = json_decode($data);

$var_date = $dataJsonDecode->var_date;

$sql_get_date = "SELECT * FROM counter WHERE date = '".mysql_real_escape_string($var_date)."' ";
$resource = mysql_query($sql_get_date);
$count_row_get = mysql_num_rows($resource);
if($count_row_get > 0){
	while ($result = mysql_fetch_assoc($resource)) {
		$rows[] = $result;
	}
	$data = json_encode($rows);
	$totaldata = sizeof($rows);
	$get_date = '{"get_date":'.$data.'}';
}
else{
	$get_date = '{"get_date":"null"}';
}
echo $get_date;
?>