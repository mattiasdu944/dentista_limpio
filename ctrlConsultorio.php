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
    
 
        $consul = new Mattias\Dentista\Consultorio(
            $_POST['modDireccion'],
            $_POST['modHorarioConsultorio'],
            $_POST["modIdConsultorio"],
        );
        if ($consul->modificar(new Mattias\Dentista\Mysql())) {
            header('Location:admConsultorio.php');
        }
        else {
            echo "MAL";
        }
        break;

    case 'Eliminar':
        var_dump($_POST);
        $id = $_POST['elimConsulId'];

        $user = new Mattias\Dentista\Consultorio(null,null,$id);

        if ($user->eliminar(new Mattias\Dentista\Mysql())) {
            header('Location:admConsultorio.php');
        }
        else {
            echo "MAL";
        }
        break;

    default:
        break;
}


?>