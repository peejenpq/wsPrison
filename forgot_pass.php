<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
mysql_connect("localhost","root","masterkey");
mysql_select_db("bomb");
$data = file_get_contents("php://input");
$dataJsonDecode = json_decode($data);

$var_id = $dataJsonDecode->var_id;
$var_email = $dataJsonDecode->var_email;

$id = $var_id;
$email = $var_email;

$sql = "SELECT * FROM users WHERE users_login = '".$id."' and email = '".$email."'";
$query = mysql_query($sql);
$result = mysql_fetch_array($query);

// $resource = mysql_query($sql);
// $count_row = mysql_num_rows($resource);

//Forgot password Section
function random_password($len)
{
	srand((double)microtime()*10000000);
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$ret_str = "";
	$num = strlen($chars);
	for($i = 0; $i < $len; $i++)
	{
		$ret_str.= $chars[rand()%$num];
		$ret_str.=""; 
	}
	return $ret_str; 
}
// echo random_password(8); 
$password = random_password(5);
$update = "UPDATE users SET users_pass = '".md5(($password))."' WHERE users_login = '".$id."';";
//forgot
?>