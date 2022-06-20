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

        break;

    case 'Eliminar':
        break;

    
    
    default:
        break;
}


?>