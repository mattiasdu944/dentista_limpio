<?php 
require_once("vendor/autoload.php");
$op = $_POST['btn'];

switch ($op) {

    case 'Guardar':
        var_dump($_POST);
            
        $state = isset($_POST["statusProcedimiento"]) ? 1 : 0;
        $procedimiento = new Mattias\Dentista\Procedimiento(
            $_POST["tipoProcedimiento"],
            $state,
            $_POST["costoProcedimiento"]
        );

        if ($procedimiento->insertar(new Mattias\Dentista\Mysql())) {
            header('Location:admProcedimientos.php');
        }
        else {
            echo "MAL";
        }
        break;


    case 'Modificar':
        

        $state = isset($_POST["statusProcedimiento"]) ? 1 : 0;
        var_dump($_POST);

        $prod = new Mattias\Dentista\Procedimiento(
            $_POST["modProcedimiento"],
            $state,
            $_POST['modCosto'],
            $_POST['modId']
        );
        if ($prod->modificar(new Mattias\Dentista\Mysql())) {
            header('Location:admProcedimientos.php');
        }
        else {
            echo "MAL";
        }
        break;



    case 'Eliminar':
        $id = $_POST['elimProcId'];
        echo $id;

        $procedimiento = new Mattias\Dentista\Procedimiento(null,null,null,$id);
        if ($procedimiento->eliminar(new Mattias\Dentista\Mysql())) {
           header('Location:admProcedimientos.php');
        
        }else {
           echo "MAL";
        }
        break;

    default:
        echo "No se realizo ninguna accion";
        break;
}


?>