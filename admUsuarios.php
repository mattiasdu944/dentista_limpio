<?php
    require_once("seguridad.php");
    require_once("vendor/autoload.php");
    
    $listaUsuarios = Mattias\Dentista\Usuarios::listarJoin(new Mattias\Dentista\Mysql());
    $listaRoles = Mattias\Dentista\Rol::listar(new Mattias\Dentista\Mysql());
    // var_dump($listaRoles);
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
    <title>Lista Usuarios</title>
</head> 

<body>
    <?php include('parcials/sidebar.php');?>
    <main class="container section">
        <div class="pacientes_title">
            <h1>Listado de Usuarios</h1>
            <p>
                Administra tus Pacientes aquí.
            </p>
        </div>
        <hr>
            <p><span class="special_text big-text">
                    <?=count($listaUsuarios)?>
                </span> Pacientes</p>

            <!-- Button Agregar Paciente -->
            <button type="button" class="d-flex btn_paciente btn-xs special_text" data-bs-toggle="modal"
                data-bs-target="#modalUsuario">
                <i class="uil uil-plus"></i> Agregar Usuario
            </button>

            <!-- Modal Agregar Paciente -->
            <div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Agregar Paciente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="ctrlUsuario.php" method="POST">
                                <div class=" mb-3">
                                    <label for="usrNombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" name="usrNombre" id="usrNombre"
                                        aria-describedby="helpId" placeholder="Ingresa tu Nombre">
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="usrPaterno" class="form-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" name="usrPaterno" id="usrPaterno"
                                            aria-describedby="helpId">
                                    </div>
                                    <div class="col-12 col-md-6  mb-3 ">
                                        <label for="usrMaterno" class="form-label">Apellido Materno</label>
                                        <input type="text" class="form-control" name="usrMaterno" id="usrMaterno"
                                            aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="usrCorreo" class="form-label">Correo</label>
                                    <input type="email" class="form-control" name="usrCorreo" id="usrCorreo"
                                        aria-describedby="helpId">
                                </div>
                                <div class="mb-3">
                                    <label for="usrContraseña" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" name="usrContraseña" id="usrContraseña"
                                        aria-describedby="helpId">
                                </div>

                                <select class="mb-3 form-select" name="usrRol" id="usrRol"
                                    aria-label="Default select example">
                                    <?php foreach ($listaRoles as $rol) { ?>
                                    <option value="<?= $rol->getId()?>">
                                        <?= $rol->getDescripcion()?>
                                    </option>
                                    <?php }?>
                                </select>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" value="Guardar" name="btn" class="btn btn-primary">Guardar Usuario</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        <?php
            if(count($listaUsuarios)> 0){
        ?>
        <div class="scroll">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre/s</th>
                        <th scope="col">Apellido/s</th>
                        <th scope="col">Correo Electronico</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <?php foreach ($listaUsuarios as $usuario) { ?>
                <tr>
                    <td>
                        <?= $usuario->id?>
                    </td>
                    <td>
                        <?= $usuario->nombres; ?>
                    </td>
                    <td>
                        <?= $usuario->paterno?>
                        <?= $usuario->materno?>
                    </td>
                    <td>
                        <?= $usuario->correo?>
                    </td>
                    <td>
                        <?= $usuario->descripcion?>
                    </td>
                    <td class="table_actions">
                        <button type="button" class="button-editar" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"
                            data-ci="<?= $usuario->id?>"
                            data-nombres="<?= $usuario->nombres?>"
                            data-paterno="<?= $usuario->paterno?>"
                            data-materno="<?= $usuario->materno?>"
                            data-correo="<?= $usuario->correo?>"
                            data-rol="<?= $usuario->rol?>"
                            onclick="modificarPaciente(event)"
                        >
                            <i class="uil uil-pen"></i>
                        </button>
                        <button type="button" class="button-borrar" data-bs-toggle="modal"
                            data-bs-target="#eliminarPaciente"
                            data-id="<?= $usuario->id?>"
                            data-nombre = "<?= $usuario->nombres?>"
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
                            <form action="ctrlPaciente.php" method="POST">
                                <div class="row">
                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="modPacNombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="modPacNombre" id="modPacNombre"
                                            aria-describedby="helpId" >
                                    </div>
                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="modPacCI" class="form-label">CI</label>
                                        <input type="text" class="form-control" name="modPacCI" id="modPacCI"
                                            aria-describedby="helpId" >
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="modPacPaterno" class="form-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" name="modPacPaterno" id="modPacPaterno"
                                            aria-describedby="helpId">
                                    </div>
                                    <div class="col-12 col-md-6  mb-3 ">
                                        <label for="modPacMaterno" class="form-label">Apellido Materno</label>
                                        <input type="text" class="form-control" name="modPacMaterno" id="modPacMaterno"
                                            aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="modPacEdad" class="form-label">Edad</label>
                                        <input type="number" class="form-control" name="modPacEdad" id="modPacEdad">
                                    </div>
                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="modPacTelefono" class="form-label">Telefono</label>
                                        <input type="number" max="99999999" class="form-control" name="modPacTelefono"
                                            id="modPacTelefono" aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="modPacCorreo" class="form-label">Correo</label>
                                    <input type="email" class="form-control" name="modPacCorreo" id="modPacCorreo"
                                        aria-describedby="helpId">
                                </div>

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" value="Modificar" name="btn" class="btn btn-primary">Modificar Paciente</button>
                            </form>
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
            <h4 class="alert-heading">No hay Usuarios registrados</h4>
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

        const modificarPaciente= e =>{
            const ci = document.getElementById('modPacCI');
            const nombre = document.getElementById('modPacNombre');
            const edad = document.getElementById('modPacEdad');
            const telefono = document.getElementById('modPacTelefono');
            const correo = document.getElementById('modPacCorreo');
            const paterno = document.getElementById('modPacPaterno');
            const materno = document.getElementById('modPacMaterno');

            ci.value = e.currentTarget.dataset.ci;
            nombre.value = e.currentTarget.dataset.nombres;
            edad.value = e.currentTarget.dataset.edad;
            telefono.value = e.currentTarget.dataset.telefono;
            correo.value = e.currentTarget.dataset.correo;
            paterno.value = e.currentTarget.dataset.paterno;
            materno.value = e.currentTarget.dataset.materno;
        }
    </script>
</body>


</html>