<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "instagram";

$conn = mysqli_connect($host,$username,$password,$dbname);
if(!$conn){
	echo 'Kesalahan Koneksi Database '.mysqli_connect_error();
} 

?>