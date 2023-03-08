<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$server = "localhost";
$user = "root";
$pass = "";
$dbname = "paymentreceipt_apps";
    
//$base_url = "http://localhost/koperasi/";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$koneksi = mysqli_connect($server,$user,$pass,$dbname);

if(mysqli_connect_errno()){
	echo "Koneksi database gagal".mysqli_connect_error();
}

?>