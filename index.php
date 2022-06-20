<?php
require_once("vendor/autoload.php");
echo"creando el objeto mysql...";
$mysql = new Mattias\Dentista\Mysql();
$con = $mysql->getconexion();
var_dump($con);
?>



/*
<?php
session_start();
require_once("vendor/autoload.php");
$listaUsr = Mattias\Dentista\Usuario::listarJoin(new Mattias\Dentista\Mysql());
$listaRoles = Mattias\Dentista\Rol::listar(new Mattias\Dentista\Mysql());
//var_dump($listaRoles);
//var_dump($listaUsr);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modulo de administracion de Usuarios</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<?php include('parciales/nav.php');?>
<div class="container mt-5">

</div>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
</body>
</html>
*/