<?php
require_once("vendor/autoload.php");
// var_dump($_POST);
if (isset($_POST["correoUsuario"]) && isset($_POST["passUsuario"])) {
    var_dump($_POST);
    $usuario = Mattias\Dentista\Usuarios::getCorreoUsr(new Mattias\Dentista\Mysql(), $_POST["correoUsuario"]);
    if (password_verify($_POST["passUsuario"], $usuario->getPassword())) {
        session_start();
        $_SESSION["usuario"] = $usuario->getNombres();
        $_SESSION["correo"] = $usuario->getCorreo();
        $_SESSION["rol"] = $usuario->getRol();
        $_SESSION["pass"] = $usuario->getPassword();
        header('Location:admPaciente.php');
    }
    else{
        echo "Usuario o contraseña incorrectos";
    }
}

?>
