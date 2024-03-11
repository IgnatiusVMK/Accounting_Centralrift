<?php  

$sname= "localhost";
$uname= "root";
$password = "";

$db_name = "accounting_central";

$conn1 = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn1) {
	echo "Connection failed";
}