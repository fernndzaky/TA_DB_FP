<?php  

$servername = "dbta.1ez.xyz";
$username = "YOH0100";
$password = "6ib0s52w";
$dbname = "18_Guapdad";

$connection = mysqli_connect($servername,$username,$password,$dbname);

if(! $connection){
	die ("Connection Failed : ". mysqli_connect_error());
}


?>