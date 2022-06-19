<?php
    require_once("vendor/autoload.php");
    
    $listaProcedimientos = Mattias\Dentista\Procedimiento::listar(new Mattias\Dentista\Mysql());
    // var_dump($listaProcedimientos);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="./Css/bootstrap.min.css">
    <title>Lista de Pacientes</title>
</head>

<body>
    <?php include('parcials/sidebar.php');?>
    <main class="container section">
        <div class="pacientes_title">
            <h1>Procedimientos Odontologicos</h1>
            <p>
                Administra tus tus servicios y procedimientos aquí.
            </p>
        </div>
        <hr>
        <div class="d-flex">
            
            <p><span class="special_text big-text"><?=count($listaProcedimientos)?></span> Procedimiento</p>
            
        </div>
        <div class="scroll">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tipo/s</th>
                        <th scope="col">Estado/s</th>
                        <th scope="col">Costo Promedio</th>
                    </tr>
                </thead>
                <?php foreach ($listaProcedimientos as $procedimiento) { ?>
                <tr>
                    <td>
                        <?php echo $procedimiento->getId(); ?>
                    </td>
                    <td>
                        <?= $procedimiento->getTipo_procedimiento(); ?>
                    </td>
                    <td>
                        <?= $procedimiento->getEstado();?>
                    </td>
                    <td>
                        <?= $procedimiento->getCosto(); ?>
                    </td>
                    <td class="table_actions">
                        <button type="button" class="button-editar" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <i class="uil uil-pen"></i>
                        </button>
                        <button type="button" class="button-borrar" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <i class="uil uil-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>


    <style>
        * {
            transition: all 0.3s ease-in-out;
        }

        .big-text{
            font-size: 2rem;
            font-weight: bold;
        }

        .pacientes_title h1{
            font-weight: bold;
        }	
        .special_text{
            color: hsl(228, 81%, 49%);
        }
        .scroll {
            overflow-x: auto;
            background-color: white;
            padding: 1rem 2rem;
            border-radius: 10px;
            box-shadow: 0 8px 24px hsla(228, 81%, 24%, .15);
            max-width: 100%;
        }

        @media screen and (max-width: 576px) {
            .scroll {
                overflow-x: auto;
                background-color: white;
                padding: 1rem 2rem;
                border-radius: 10px;
                box-shadow: 0 8px 24px hsla(228, 81%, 24%, .15);
                max-width: 90%;
            }
        }
            
        
        td {
            color: hsl(228, 8%, 50%);
        }

        i {
            cursor: pointer;
            display: flex;
        }

        button {
            border: none;
            background-color: transparent;
        }

        .button-editar {
            display: flex;
            justify-content: center;
        }

        .button-editar:hover i {
            transform: translateY(-2px);
            color: hsl(228, 81%, 49%);
        }

        .button-borrar {
            display: flex;
            justify-content: center;
        }

        .button-borrar:hover i {
            transform: translateY(-2px);
            color: hsl(0, 100%, 61%);
        }


        .table_actions {
            display: flex;
            justify-content: space-around;
        }
    </style>
    <script src="./Javascript/bootstrap.min.js"></script>
</body>


</html>