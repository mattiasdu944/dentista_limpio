<?php
require_once("vendor/autoload.php");
echo"creando el objeto mysql...";
$mysql = new Mattias\Dentista\Mysql();
$con = $mysql->getconexion();
var_dump($con);
?>