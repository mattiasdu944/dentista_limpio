<?php
    require_once("vendor/autoload.php");
    $listaHorarios = Mattias\Dentista\Horarios::listar(new Mattias\Dentista\Mysql());
    $listaConsultorioHorario = Mattias\Dentista\Consultorio::listarConsultorio_Horario(new Mattias\Dentista\Mysql());
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
            <h1>Administrador de Consultorios</h1>
            <p>
                Administra tus Consultorios aquí.
            </p>
        </div>
        <hr>
        <section class="section main grid">
            <div class="form_citas">
                <div class="form_citas_title">
                    <h3>Agregar Consultorio</h3>
                </div>
                <form action="ctrlConsultorio.php" method="POST">


                    <div class="  mb-3">
                        <label for="dirConsultorio" class="form-label">Direccion/s</label>
                        <input type="text" class="form-control" name="dirConsultorio" id="dirConsultorio"
                            aria-describedby="helpId" placeholder="Ingresa la direccion">
                    </div>
                    <div class="mb-3">
                        <label for="horarioConsultorio" class="form-label">Dias y Horarios</label>
                        <select class="mb-3 form-select" name="horarioConsultorio" id="horarioConsultorio"
                            aria-label="Default select example">
                            <?php foreach ($listaHorarios as $horario) { ?>
                            <option value="<?= $horario->getId()?>">
                                <?= $horario->getDias()?>
                                <?= $horario->getHoras()?>
                            </option>
                            <?php }?>
                        </select>
                    </div>


                    <button type="submit" name="btn" value="Guardar" class="btn btn-primary">Guardar</button>
                </form>
            </div>

            <div class="lista_citas">
                <div class="lista_citas_title">
                    <h3>Consultorios</h3>
                </div>
                <?php foreach ($listaConsultorioHorario as $consultorio) { ?>
                    <div class="mb-3 cita_item">
                        <div class="row">
                            <div class="col-6 cita_item_title">
                                <h3>Consultorio <?= $consultorio->id?></h3>
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
                                <div class="mb-3 cita_item_body_item">
                                    <div class="cita_item_body_item_title">
                                        <h4>Direccion</h4>
                                    </div>
                                    <div class="cita_item_body_item_content">
                                        <?= $consultorio->direccion?>
                                    </div>
                                </div>
                                <div class="cita_item_body_item">
                                    <div class="cita_item_body_item_title">
                                        <h4>Horarios</h4>
                                    </div>
                                    <div class="cita_item_body_item_content">
                                        <p><?= $consultorio->dias?> | <?= $consultorio->horas?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <?php } ?>
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
    </style>
    <script src="./Javascript/bootstrap.min.js"></script>
</body>


</html>