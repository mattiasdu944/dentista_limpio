<?php 

require_once("vendor/autoload.php");
$op = $_POST['btn'];

switch ($op) {
    case 'Guardar':
        var_dump($_POST);
        $usr = new Mattias\Dentista\Paciente(
            $_POST["pacCI"],
            $_POST["pacNombre"],
            $_POST["pacPaterno"],
            $_POST["pacMaterno"],
            $_POST["pacCorreo"],
            $_POST["pacTelefono"],
            $_POST["pacEdad"],
        );
        // var_dump($usr);
        if ($usr->insertar(new Mattias\Dentista\Mysql())) {
            header('Location:admPaciente.php');
        }
        else {
            echo "MAL";
        }
        break;

    case 'Modificar':
        break;

    case 'Eliminar':

        $id = $_POST['elimPacCI'];

        $user = new Mattias\Dentista\Paciente($id,null,null,null,null,null,null);

        if ($user->eliminar(new Mattias\Dentista\Mysql())) {
            header('Location:admPaciente.php');
        }
        else {
            echo "MAL";
        }
        break;


    
    
    default:
        break;
}


?>