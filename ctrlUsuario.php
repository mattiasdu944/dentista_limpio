<?php 

require_once("vendor/autoload.php");
$op = $_POST['btn'];

switch ($op) {
    case 'Guardar':
        var_dump($_POST);
        $usr = new Mattias\Dentista\Usuarios(
            $_POST["usrNombre"],
            $_POST["usrPaterno"],
            $_POST["usrMaterno"],
            $_POST["usrCorreo"],
            $_POST["usrContraseña"],
            $_POST["usrRol"]
        );
        // var_dump($usr);
        if ($usr->insertar(new Mattias\Dentista\Mysql())) {
            header('Location:admUsuarios.php');
        }
        else {
            echo "MAL";
        }
        break;

    case 'Modificar':
        var_dump($_POST);
        $usuario = new Mattias\Dentista\Usuarios(
            $_POST['modUsrNombre'],
            $_POST['modUsrPaterno'],
            $_POST["modUsrMaterno"],
            $_POST["modUsrCorreo"],
            $_POST["modUsrPass"],
            $_POST["modUsrRol"],
            $_POST["modUsrId"]
        );
        if ($usuario->modificar(new Mattias\Dentista\Mysql())) {
            header('Location:admUsuarios.php');
        }
        else {
            echo "MAL";
        }
        break;

    case 'Eliminar':
        $id = $_POST['elimUsrId'];

        $user = new Mattias\Dentista\Usuarios(null,null,null,null,null,null,$id);

        if ($user->eliminar(new Mattias\Dentista\Mysql())) {
            header('Location:admUsuarios.php');
        }
        else {
            echo "MAL";
        }
        break;

    
    
    default:
        break;
}


?>