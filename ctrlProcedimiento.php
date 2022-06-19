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
        if (is_uploaded_file($_FILES['mimgProdNew']['tmp_name'])) {
            // CREA EL NOMBRE DEL ARCHIVO
            $nom = $_FILES["mimgProdNew"]["name"];
            $dir = 'img/'.time().$nom;
            //GUARDA LA IMAGEN EN EL DIRECTORIO
            move_uploaded_file($_FILES['mimgProdNew']['tmp_name'],$dir);
        }
        
        else{
            $dir= $_POST['mImgProdActual'];
        }

        $state = isset($_POST["mStatusProd"]) ? 1 : 0;
        echo $state;
        $prod = new Mattias\Inventario2022\Producto(
            $_POST["mnomProd"],
            $_POST['mMarcaProd'],
            $dir,
            $_POST['mprecioProd'],
            $state,
            $_POST['mStockProd'],
            $_POST['mIdcProd'],
            $_POST['mIdProd'],
        );
        if ($prod->modificar(new Mattias\Inventario2022\Mysql())) {
            header('Location:admProducto.php');
        }
        else {
            echo "MAL";
        }
        break;



    case 'Eliminar':
        $id = $_POST['elimIdCategoria'];

        $cat = new Mattias\Inventario2022\Categoria(null,null,$id);

        if ($cat->eliminar(new Mattias\Inventario2022\Mysql())) {
            header('Location:admCategoria.php');
        }
        else {
            echo "MAL";
        }
        break;

    default:
        echo "No se realizo ninguna accion";
        break;
}


?>