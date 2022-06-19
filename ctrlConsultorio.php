<?php 

require_once("vendor/autoload.php");
$op = $_POST['btn'];

switch ($op) {
    case 'Guardar':
        var_dump($_POST);
        $consul = new Mattias\Dentista\Consultorio(
            $_POST["dirConsultorio"],
            $_POST["horarioConsultorio"]
        );
        // var_dump($usr);
        if ($consul->insertar(new Mattias\Dentista\Mysql())) {
            header('Location:admConsultorio.php');
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