<?php
    require_once("seguridad.php");
    require_once("vendor/autoload.php");
    $listaProcedimientos = Mattias\Dentista\Procedimiento::listarActivos(new Mattias\Dentista\Mysql());
    $listaConsultorio = Mattias\Dentista\Consultorio::listar(new Mattias\Dentista\Mysql());
    $listaPaciente = Mattias\Dentista\Paciente::listar(new Mattias\Dentista\Mysql());

    $listaCitas = Mattias\Dentista\Cita::listarJoin(new Mattias\Dentista\Mysql());
    $Date = date('Y-m-d', time()); 
    $Time = date('h:i a', time());
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
        <setion class="section main grid">
            <div class="form_citas">
                <div class="form_citas_title">
                    <h3>Agendar Cita</h3>
                </div>
                <form  class="formulario"action="ctrlCitas.php" method="POST">
                    <div class="mb-3">
                        <label for="citaPaciente" class="form-label">Pacientes</label>
                        <select class="mb-3 form-select" name="citaPaciente" id="citaPaciente"
                            aria-label="Default select example">
                            <?php foreach ($listaPaciente as $paciente) { ?>
                            <option value="<?= $paciente->getCi()?>">
                                <?= $paciente->getNombres(); ?>
                                <?= $paciente->getPaterno(); ?>
                                <?= $paciente->getMaterno(); ?>
                            </option>
                            <?php }?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="citaProcedimiento" class="form-label">Procedimiento</label>
                        <select class="mb-3 form-select" name="citaProcedimiento" id="citaProcedimiento"
                            aria-label="Default select example">
                            <?php foreach ($listaProcedimientos as $procedimiento) { ?>
                            <option value="<?= $procedimiento->getId()?>">
                                <?= $procedimiento->getTipo_procedimiento(); ?>
                            </option>
                            <?php }?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="citaConsultorio" class="form-label">Direccion del Consultorio</label>
                        <select class="mb-3 form-select" name="citaConsultorio" id="citaConsultorio"
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
                            <input type="date" class="form-control" name="citaFecha" id="citaFecha" min="<?=$Date?>"
                                max="2023-12-31" aria-describedby="helpId" required>
                        </div>
                        <div class="col-12 col-md-6  mb-3 ">
                            <label for="citaHora" class="form-label">Hora de la Cita</label>
                            <input type="time" class="form-control" name="citaHora" id="citaHora" min="<?=$Time?>"
                            max="19:00" aria-describedby="helpId" required>
                        </div>
                    </div>

                    <button type="submit" name="btn" value="Guardar" class="btn btn-primary">Guardar Cita</button>
                </form>
            </div>
            <div class="lista_citas">
                <div class="lista_citas_title">
                    <h3>Lista de Citas</h3>
                </div>

                <div class="scroll_citas">
                    <?php 
                        $contador=0;
                        foreach(array_reverse($listaCitas) as $cita){
                            $contador++;
                    ?>

                
                    <div class="cita_item mb-3">
                        <div class="row">
                            <div class="col-6 cita_item_title">
                                <h3>Cita
                                    <?php echo $contador?>
                                </h3>
                            </div>
                            <div class="col-6 cita_item_icons">
                                <button type="button" class="button-editar" data-bs-toggle="modal"
                                    data-bs-target="#modificarCita"
                                    data-id="<?= $cita->id?>"
                                    data-paciente="<?= $cita->paciente?>"
                                    data-procedimiento="<?=$cita->procedimiento?>"
                                    data-consultorio="<?= $cita->consultorio?>"
                                    data-fecha="<?= $cita->fecha?>"
                                    data-hora="<?= $cita->hora_atencion?>"
                                    data-telefono="<?= $cita->telefono?>"
                                    onclick="modificarCita(event)"
                                    >
                                    <i class="uil uil-pen"></i>
                                </button>
                                <button type="button" class="button-borrar" 
                                    data-bs-toggle="modal"
                                    data-bs-target="#elimCitaModal"
                                    data-id="<?=$cita->id?>"
                                    onclick="eliminarCita(event)"
                                    >
                                    
                                    <i class="uil uil-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                        <div class="cita_item_body">
                            <div class="cita_item_body_item">
                                <div class="cita_item_body_item_title">
                                    <h4>Nombre Completo</h4>
                                </div>
                                <div class="cita_item_body_item_content">
                                    <p>
                                        <?=$cita->nombres?>
                                        <?=$cita->paterno?>
                                        <?=$cita->materno?>
                                    </p>
                                </div>
                            </div>
                            <div class=" cita_item_body_item">
                                <div class="cita_item_body_item_title">
                                    <h4>Consultorio</h4>
                                </div>
                                <div class=" cita_item_body_item_content">
                                    <p>
                                        <?=$cita->direccion?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6  cita_item_body_item">
                                    <div class="cita_item_body_item_title">
                                        <h4>Procedimiento a realizar</h4>
                                    </div>
                                    <div class="cita_item_body_item_content">
                                        <p>
                                            <?=$cita->tipo_procedimiento?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6  cita_item_body_item">
                                    <div class="cita_item_body_item_title">
                                        <h4>Telefono</h4>
                                    </div>
                                    <div class="cita_item_body_item_content">
                                        <p>
                                            <?=$cita->telefono?>
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <div class="row">


                                <div class="col-12 col-md-6 cita_item_body_item">
                                    <div class="cita_item_body_item_title">
                                        <h4>Fecha</h4>
                                    </div>
                                    <div class="cita_item_body_item_content">
                                        <p id="fechaCita">
                                            <?=$cita->fecha?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 cita_item_body_item">
                                    <div class="cita_item_body_item_title">
                                        <h4>Hora</h4>
                                    </div>
                                    <div class="cita_item_body_item_content">
                                        <p>
                                            <?=$cita->hora_atencion?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
                <!-- MODAL ELIMINAR CITA-->
                <div class="modal fade" id="elimCitaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="ctrlCitas.php" method="POST">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Cita</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden"  name="elimCitaId" id="elimCitaId">
                                    <p>¿Esta seguro de eliminar la cita?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" value="Eliminar" name="btn" class="btn btn-danger">Eliminar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- MODAL MODIFICAR PACIENTE -->
                <div class="modal fade" id="modificarCita" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modificar Cita</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="ctrlCitas.php" method="POST">
                                    <input type="hidden" name="modId" id="modId">

                                    <div class="mb-3">
                                        <label for="citaPacmodCitaPacienteiente" class="form-label">Pacientes</label>
                                        <select class="mb-3 form-select" name="modCitaPaciente" id="modCitaPaciente"
                                            aria-label="Default select example" required>
                                            <?php foreach ($listaPaciente as $paciente) { ?>
                                                <option value="<?= $paciente->getCi()?>">
                                                    <?= $paciente->getNombres(); ?>
                                                    <?= $paciente->getPaterno(); ?>
                                                    <?= $paciente->getMaterno(); ?>
                                                </option>
                                            <?php }?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="modCitaProcedimiento" class="form-label">Procedimiento</label>
                                        <select class="mb-3 form-select" name="modCitaProcedimiento" id="modCitaProcedimiento"
                                            aria-label="Default select example" required>
                                            <?php foreach ($listaProcedimientos as $procedimiento) { ?>
                                                <option value="<?= $procedimiento->getId()?>">
                                                    <?= $procedimiento->getTipo_procedimiento(); ?>
                                                </option>
                                            <?php }?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="modCitaConsultorio" class="form-label">Direccion del Consultorio</label>
                                        <select class="mb-3 form-select" name="modCitaConsultorio" id="modCitaConsultorio"
                                            aria-label="Default select example" required >
                                            <?php foreach ($listaConsultorio as $consultorio) { ?>
                                                <option value="<?= $consultorio->getId()?>">
                                                    <?= $consultorio->getDireccion(); ?>
                                                </option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6  mb-3 ">
                                            <label for="modCitaFecha" class="form-label">Fecha de la Cita</label>
                                            <input type="date" class="form-control" name="modCitaFecha" id="modCitaFecha" min="<?=$Date?>"
                                                max="2023-12-31" aria-describedby="helpId" required>
                                        </div>
                                        <div class="col-12 col-md-6  mb-3 ">
                                            <label for="modCitaHora" class="form-label">Hora de la Cita</label>
                                            <input type="time" class="form-control" name="modCitaHora" id="modCitaHora" min="<?=$Time?>"
                                                max="19:00" aria-describedby="helpId" required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" value="Modificar" name="btn" class="btn btn-primary">Modificar</button>
                                    </div>

                                </form>
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
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
        }

        /* FORMULARIO DE LAS CITAS */
        .formulario {
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

        .card_item h3,
        h4,
        h5,
        h6 {
            font-weight: bold;
            color: rgb(51, 51, 51);
        }

        .cita_item_body_item_title h4 {
            font-size: 1.2rem;
        }

        .cita_item_icons {
            display: flex;
            justify-content: end;
            gap: 2rem;
            align-items: center;
        }

        i {
            cursor: pointer;
            display: flex;
            font-size: 1.25rem;
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

        .scroll_citas{
            padding:0rem 1rem;
            height: 70vh;
            overflow-y: scroll;
            overflow-x: hidden;
        }
    </style>



    <script src="./Javascript/bootstrap.min.js"></script>
    <script>
        const eliminarCita = e => {
            const id = e.currentTarget.dataset.id;
            document.getElementById('elimCitaId').value = id;
        }


        const modificarCita = e =>{
            const id = document.getElementById('modId');
            const paciente = document.getElementById('modCitaPaciente');
            const consultorio = document.getElementById('modCitaConsultorio');
            const procedimiento = document.getElementById('modCitaProcedimiento');
            const fecha = document.getElementById('modCitaFecha');
            const hora = document.getElementById('modCitaHora');

            procedimiento.value = e.currentTarget.dataset.procedimiento;
            paciente.value = e.currentTarget.dataset.paciente;
            consultorio.value = e.currentTarget.dataset.consultorio;
            fecha.value = e.currentTarget.dataset.fecha;
            hora.value = e.currentTarget.dataset.hora;
            id.value = e.currentTarget.dataset.id;
        }

    </script>
</body>


</html>