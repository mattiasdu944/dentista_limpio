<?php
    require_once("vendor/autoload.php");
    $listaProcedimientos = Mattias\Dentista\Procedimiento::listarTodo(new Mattias\Dentista\Mysql());
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
            
            <p><span class="special_text big-text"><?=count($listaProcedimientos)?></span> Procedimiento</p>
            <button type="button" class="mb-3 d-flex btn_paciente btn-xs special_text" data-bs-toggle="modal"
                data-bs-target="#modelProcedimiento">
                <i class="uil uil-plus"></i> Agregar Procedimiento
            </button>

            <!-- Modal Agregar Paciente -->
            <div class="modal fade" id="modelProcedimiento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Agregar Procedimiento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="ctrlProcedimiento.php" method="POST">
                                <div class="  mb-3">
                                    <label for="tipoProcedimiento" class="form-label">Tipo de Procedimiento</label>
                                    <input type="text" class="form-control" name="tipoProcedimiento" id="tipoProcedimiento"
                                        aria-describedby="helpId" placeholder="Ingresa tu Nombre">
                                </div>

                                <div class="mb-3">
                                    <label for="costoProcedimiento" class="form-label">Costo promedio del procedimiento</label>
                                    <input type="number" class="form-control" name="costoProcedimiento" id="costoProcedimiento"
                                        aria-describedby="helpId">
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" name="statusProcedimiento" id="statusProcedimiento" value="checkedValue" checked>
                                    <label class="form-check-label" for="statusProcedimiento">
                                      Estado
                                    </label>
                                </div>

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" value="Guardar" name="btn" class="btn btn-primary">Guardar Procedimiento</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       
        <div class="scroll">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th >Tipo de Procedimiento</th>
                        <th >Estado</th>
                        <th >Costo Promedio</th>
                        <th >Acciones</th>
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
                        <?php
                            if($procedimiento->getEstado() == 1){
                                echo "Activo";
                            }else{
                                echo "Inactivo";
                            }
                        ?>
                    </td>
                    <td>
                        <?= $procedimiento->getCosto()?>$
                    </td>
                    <td class="table_actions">

                        <!-- BOTON EDITAR -->
                        <button type="button" class="button-editar" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <i class="uil uil-pen"></i>
                        </button>

                        <!-- BOTON BORRAR -->
                        <button 
                            type="button" 
                            class="button-borrar" 
                            data-bs-toggle="modal"
                            data-bs-target="#elimModalProcedimiento"
                            
                            data-id="<?php echo $procedimiento->getId()?>"
                            data-procedimiento="<?php echo $procedimiento->getTipo_procedimiento()?>"
                            onclick="eliminarProcedimiento(event)"
                            >
                            
                            
                            <i class="uil uil-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table> 


            <!-- MODAL BORRAR PROCEDIMIENTO -->
            <div class="modal fade" id="elimModalProcedimiento" tabindex="-1" aria-labelledby="elimModalProcedimiento" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="ctrlProcedimiento.php" method="POST">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Paciente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden"  name="elimProcId" id="elimProcId">
                                <p>¿Esta seguro de eliminar el Procedimiento <span id="procedimiento"></span>?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" value="Eliminar" name="btn" class="btn btn-primary">Eliminar</button>
                            </div>
                        </form>
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
                max-width: 100%;
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
    <script>
        const eliminarProcedimiento = (e) =>{
            const id = e.currentTarget.dataset.id;
            const procedimiento = e.currentTarget.dataset.procedimiento;

            document.getElementById('procedimiento').innerHTML = procedimiento;
            document.getElementById('elimProcId').value = id;
        }
    </script>
</body>


</html>