<?php
    require_once("vendor/autoload.php");
    $listaProcedimientos = Mattias\Dentista\Procedimiento::listar(new Mattias\Dentista\Mysql());
    $listaConsultorio = Mattias\Dentista\Consultorio::listar(new Mattias\Dentista\Mysql());
    $listaPaciente = Mattias\Dentista\Paciente::listar(new Mattias\Dentista\Mysql());
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
            <h1>Administrador de Citas</h1>
            <p>
                Agrega y administra tus citas.
            </p>
        </div>
        <hr>
        <!-- <div class="scroll">

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">CI</th>
                        <th scope="col">Nombre/s</th>
                        <th scope="col">Apellido/s</th>
                        <th scope="col">Correo Electronico</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Citas</th>
                        <th scope="col">Consultorio</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tr>
                    <td>10017600</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>duartemattias3@gmail.com</td>
                    <td>76290741</td>
                    <td>19</td>
                    <td>Pendiente</td>
                    <td>Miraflores</td>
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
                <tr>
                    <td>10017700</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>duartemattias3@gmail.com</td>
                    <td>76290741</td>
                    <td>19</td>
                    <td>Pendiente</td>
                    <td>Miraflores</td>
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
                <tr>
                    <td>6081239</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>duartemattias3@gmail.com</td>
                    <td>76290741</td>
                    <td>19</td>
                    <td>Pendiente</td>
                    <td>Miraflores</td>
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
        </div> -->
        <setion class="section main grid">
            <div class="form_citas">
                <div class="form_citas_title">
                    <h3>Agendar Cita</h3>
                </div>
                <form action="ctrlCitas.php" method="POST">
                    <!-- <div class="row">

                        <div class="col-12 col-md-6  mb-3">
                            <label for="pacNombre" class="form-label">Nombre/s</label>
                            <input type="text" class="form-control" names="pacNombre" id="pacNombre"
                                aria-describedby="helpId" placeholder="Ingresa tu nombre">
                        </div>
                        <div class="col-12 col-md-6  mb-3">
                            <label for="pacCI" class="form-label">CI</label>
                            <input type="text" class="form-control" name="pacCI" id="pacCI" aria-describedby="helpId"
                                placeholder="Ingresa tu CI">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6  mb-3">
                            <label for="pacPaterno" class="form-label">Apellido Paterno</label>
                            <input type="text" class="form-control" name="pacPaterno" id="pacPaterno" aria-describedby="helpId">
                        </div>
                        <div class="col-12 col-md-6  mb-3 ">
                            <label for="pacMaterno" class="form-label">Apellido Materno</label>
                            <input type="text" class="form-control" name="pacMaterno" id="pacMaterno" aria-describedby="helpId">
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12 col-md-6  mb-3">
                            <label for="pacEdad" class="form-label">Edad</label>
                            <input type="number" class="form-control" name="pacEdad" id="pacEdad">
                        </div>
                        <div class="col-12 col-md-6  mb-3">
                            <label for="pacTelefono" class="form-label">Telefono</label>
                            <input type="number" max="99999999" class="form-control" name="pacTelefono" id="pacTelefono" aria-describedby="helpId">
                        </div>
                        
                    </div>
                    <div class="mb-3">
                        <label for="pacCorreo" class="form-label">Correo</label>
                        <input type="email" class="form-control" name="pacCorreo" id="pacCorreo" aria-describedby="helpId">
                    </div> -->
                    <div class="mb-3">
                        <label for="procConsultorio" class="form-label">Pacientes</label>
                        <select class="mb-3 form-select" name="procConsultorio" id="procConsultorio"
                            aria-label="Default select example">
                            <?php foreach ($listaPaciente as $paciente) { ?>
                            <option value="<?= $paciente->getCi()?>">
                                <?= $paciente->getNombres(); ?> <?= $paciente->getPaterno(); ?> <?= $paciente->getMaterno(); ?>
                            </option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="procConsultorio" class="form-label">Procedimiento</label>
                        <select class="mb-3 form-select" name="procConsultorio" id="procConsultorio"
                            aria-label="Default select example">
                            <?php foreach ($listaProcedimientos as $procedimiento) { ?>
                            <option value="<?= $procedimiento->getId()?>">
                                <?= $procedimiento->getTipo_procedimiento(); ?>
                            </option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="procConsultorio" class="form-label">Direccion del Consultorio</label>
                        <select class="mb-3 form-select" name="procConsultorio" id="procConsultorio"
                            aria-label="Default select example">
                            <?php foreach ($listaConsultorio as $consultorio) { ?>
                            <option value="<?= $consultorio->getId()?>">
                                <?= $consultorio->getDireccion(); ?>
                            </option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6  mb-3 ">
                            <label for="citaFecha" class="form-label">Fecha de la Cita</label>
                            <input type="date" class="form-control" name="citaFecha" id="citaFecha" aria-describedby="helpId">
                        </div>
                        <div class="col-12 col-md-6  mb-3 ">
                            <label for="citaFecha" class="form-label">Hora de la Cita</label>
                            <input type="time" class="form-control" name="citaHora" id="citaFecha" aria-describedby="helpId">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="lista_citas">
                <div class="lista_citas_title">
                    <h3>Lista de Citas</h3>
                </div>
                <div class="cita_item">
                    <div class="row">
                        <div class="col-6 cita_item_title">
                            <h3>Cita 1</h3>
                        </div>
                        <div class="col-6 cita_item_icons">
                            <button type="button" class="button-editar" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="uil uil-pen"></i>
                            </button>
                            <button type="button" class="button-borrar" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="uil uil-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                    <div class="cita_item_body">
                        <div class="row mb-3">
                            <div class="col-12 col-md-6  cita_item_body_item">
                                <div class="cita_item_body_item_title">
                                    <h4>Nombre Completo</h4>
                                </div>
                                <div class="cita_item_body_item_content">
                                    <p>Mattias Alexandre Duarte Aparicio</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6  cita_item_body_item">
                                <div class="cita_item_body_item_title">
                                    <h4>Telefono</h4>
                                </div>
                                <div class="cita_item_body_item_content">
                                    <p>76290741</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6  cita_item_body_item">
                                <div class="cita_item_body_item_title">
                                    <h4>Consultorio</h4>
                                </div>
                                <div class="cita_item_body_item_content">
                                    <p>Los Andes</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 cita_item_body_item">
                                <div class="cita_item_body_item_title">
                                    <h4>Fecha y Hora</h4>
                                </div>
                                <div class="cita_item_body_item_content">
                                    <p>19 de mayo 18:00pm</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <style>
        * {
            transition: all 0.3s ease-in-out;
        }

        .big-text {
            font-size: 2rem;
            font-weight: bold;
        }

        .special_text {
            color: hsl(228, 81%, 49%);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
            gap: 3rem;
        }

        /* FORMULARIO DE LAS CITAS */
        form {
            padding: 1.25rem 2rem;
            background-color: white;
            border-radius: .75rem;
            box-shadow: 0 8px 24px hsla(228, 81%, 24%, .15);
        }

        .cita_item {
            padding: 1.25rem 2rem;
            background-color: white;
            border-radius: .75rem;
            box-shadow: 0 8px 24px hsla(228, 81%, 24%, .15);
        }

        .card_item h3,h4,h5,h6 {
            font-weight: bold;
            color: rgb(51, 51, 51);
        }

        .cita_item_body_item_title h4{
            font-size: 1.2rem;
        }

        .cita_item_icons{
            display: flex;
            justify-content: end;
            gap:2rem;
            align-items: center;
        }

        i {
            cursor: pointer;
            display: flex;
            font-size:1.25rem;
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
    </style>



    <script src="./Javascript/bootstrap.min.js"></script>
</body>


</html>