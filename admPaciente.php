<?php
    require_once("vendor/autoload.php");
    
    $listaPacientes = Mattias\Dentista\Paciente::listar(new Mattias\Dentista\Mysql());
    // var_dump($listaPacientes);
?>
<!--uwu -->
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
            <h1>Lista de Pacientes</h1>
            <p>
                Administra tus Pacientes aquí.
            </p>
        </div>
        <hr>
            <p><span class="special_text big-text">
                    <?=count($listaPacientes)?>
                </span> Pacientes</p>

            <!-- Button Agregar Paciente -->
            <button type="button" class="d-flex btn_paciente btn-xs special_text" data-bs-toggle="modal"
                data-bs-target="#modelPaciente">
                <i class="uil uil-plus"></i> Agregar Paciente
            </button>

            <!-- Modal Agregar Paciente -->
            <div class="modal fade" id="modelPaciente" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Agregar Paciente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="ctrlPaciente.php" method="POST">
                                <div class="row">
                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="pacNombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="pacNombre" id="pacNombre"
                                            aria-describedby="helpId" placeholder="Ingresa tu Nombre">
                                    </div>
                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="pacCI" class="form-label">CI</label>
                                        <input type="text" class="form-control" name="pacCI" id="pacCI"
                                            aria-describedby="helpId" placeholder="Ingresa tu CI">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="pacPaterno" class="form-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" name="pacPaterno" id="pacPaterno"
                                            aria-describedby="helpId">
                                    </div>
                                    <div class="col-12 col-md-6  mb-3 ">
                                        <label for="pacMaterno" class="form-label">Apellido Materno</label>
                                        <input type="text" class="form-control" name="pacMaterno" id="pacMaterno"
                                            aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="pacEdad" class="form-label">Edad</label>
                                        <input type="number" class="form-control" name="pacEdad" id="pacEdad">
                                    </div>
                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="pacTelefono" class="form-label">Telefono</label>
                                        <input type="number" max="99999999" class="form-control" name="pacTelefono"
                                            id="pacTelefono" aria-describedby="helpId">
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label for="pacCorreo" class="form-label">Correo</label>
                                    <input type="email" class="form-control" name="pacCorreo" id="pacCorreo"
                                        aria-describedby="helpId">
                                </div>

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" value="Guardar" name="btn" class="btn btn-primary">Guardar Paciente</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php
            if(count($listaPacientes)> 0){
        ?>
        <div class="scroll">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">CI</th>
                        <th scope="col">Nombre/s</th>
                        <th scope="col">Apellido/s</th>
                        <th scope="col">Correo Electronico</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <?php foreach ($listaPacientes as $paciente) { ?>
                <tr>
                    <td>
                        <?= $paciente->getCi(); ?>
                    </td>
                    <td>
                        <?= $paciente->getNombres(); ?>
                    </td>
                    <td>
                        <?= $paciente->getPaterno();?>
                        <?= $paciente->getMaterno();?>
                    </td>
                    <td>
                        <?= $paciente->getCorreo(); ?>
                    </td>
                    <td>
                        <?= $paciente->getTelefono(); ?>
                    </td>
                    <td>
                        <?= $paciente->getEdad(); ?>
                    </td>
                    <td class="table_actions">
                        <button type="button" class="button-editar" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <i class="uil uil-pen"></i>
                        </button>
                        <button type="button" class="button-borrar" data-bs-toggle="modal"
                            data-bs-target="#eliminarPaciente"
                            data-id="<?= $paciente->getCi()?>"
                            data-nombre = "<?= $paciente->getNombres()?>"
                            onclick="eliminarPaciente(event)"
                            >
                            <i class="uil uil-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>

            <!-- MODAL MODIFICAR PACIENTE -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
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

            <!-- MODAL ELIMINAR PACIENTE-->
            <div class="modal fade" id="eliminarPaciente" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="ctrlPaciente.php" method="POST">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Paciente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden"  name="elimPacCI" id="elimPacCI">
                                <p>¿Esta seguro de eliminar al paciente <span id="nombrePaciente"></span>?</p>
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
        <?php
        }else{
        ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">No hay pacientes registrados</h4>
            <p>Para registrar un paciente, presione el boton de agregar paciente</p>
        </div>
        <?php
        }?>
    </main>


    <style>
        * {
            transition: all 0.3s ease-in-out;
        }

        .big-text {
            font-size: 2rem;
            font-weight: bold;
        }

        .pacientes_title h1 {
            font-weight: bold;
        }

        .special_text {
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
            align-items: center;
        }

        button {
            border: none;
            background-color: transparent;
        }

        .btn_paciente {
            gap: .1rem;
            align-items: center;
            margin: .7rem 0;
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
        const eliminarPaciente = (e) =>{
            const id = e.currentTarget.dataset.id;
            const nombre = e.currentTarget.dataset.nombre;

            document.getElementById('nombrePaciente').innerHTML = nombre;
            document.getElementById('elimPacCI').value = id;
        }
    </script>
</body>


</html>