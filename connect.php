<?php
$host = 'localhost';
$dbname = 'netflix_clone';
$username = 'root';
$password = '';

$pdo=new mysqli($host,$username,$password,$dbname);
if($pdo->connect_error)
{
	echo "error in connection";
	die;
}
?>
