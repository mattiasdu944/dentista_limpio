<?php 

require_once("vendor/autoload.php");
$op = $_POST['btn'];

switch ($op) {
    case 'Guardar':

        $cita = new Mattias\Dentista\Cita(
            $_POST["citaFecha"],
            $_POST["citaHora"],
            $_POST["citaPaciente"],
            $_POST["citaConsultorio"],
            $_POST["citaProcedimiento"]
        );
        // var_dump($usr);
        if ($cita->insertar(new Mattias\Dentista\Mysql())) {
            header('Location:admCitas.php');
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
            header('Location:admCitas.php');
        }
        else {
            echo "MAL";
        }
        break;


    
    
    default:
        echo"no se realizo ninguna accion";
        break;
}


?>