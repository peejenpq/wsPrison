<?php
header('Content-Type: application/json; charset=utf-8');
mysql_connect("localhost","root","masterkey");
mysql_select_db("prison");
mysql_query( "SET NAMES UTF8");

$data = file_get_contents("php://input");
$dataJsonDecode = json_decode($data);

$var_date = $dataJsonDecode->var_date;
$current_date = date('Y-m-d');

$sql = "SELECT counter.number , counter.date , counter.time , counter.status , all_prison.name FROM counter,all_prison WHERE counter.date = '".mysql_real_escape_string($current_date)."' AND counter.prison_id = all_prison.prison_id ";
$resource = mysql_query($sql);
$count_row = mysql_num_rows($resource);
if($count_row > 0){
	while ($result = mysql_fetch_assoc($resource)) {
		$rows[] = $result;
	}
	$data = json_encode($rows);
	$totaldata = sizeof($rows);
	$current = '{"current":'.$data.'}';
}
else{
	$current = '{"current":"null"}';
}
echo $current;
// echo $var_date;

?>