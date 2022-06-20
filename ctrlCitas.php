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
        var_dump($_POST);
        $cita = new Mattias\Dentista\Cita(
            $_POST['modCitaFecha'],
            $_POST['modCitaHora'],
            $_POST['modCitaPaciente'],
            $_POST['modCitaConsultorio'],
            $_POST['modCitaProcedimiento'],
            $_POST["modId"]
        );
        if ($cita->modificar(new Mattias\Dentista\Mysql())) {
            header('Location:admCitas.php');
        }
        else {
            echo "MAL";
        }
        break;


    case 'Eliminar':
        $id = $_POST['elimCitaId'];
        echo $id;

        $user = new Mattias\Dentista\Cita(null,null,null,null,null,$id);

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