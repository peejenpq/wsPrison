<?php
mysql_connect("localhost","root","masterkey");
mysql_select_db("bomb");
mysql_query("SET NAMES UTF8");

$sql = "SELECT * FROM prison";
$resource = mysql_query($sql);
$count_row = mysql_num_rows($resource);
if($count_row > 0){
	while ($result = mysql_fetch_assoc($resource)) {
		$rows[] = $result;
	}
	$data = json_encode($rows);
	$totaldata = sizeof($rows);
	$results = '{"results":'.$data.'}';
}
else{
	$results = '{"results":"null"}';
}
echo $results;

?>