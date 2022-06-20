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
                            <h5 class="modal-title">Agregar Usuario</h5>
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
                        <?= $usuario->nombres ?>
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
                            data-bs-target="#modificarUsuario"
                            data-id="<?= $usuario->id?>"
                            data-nombres="<?= $usuario->nombres?>"
                            data-paterno="<?= $usuario->paterno?>"
                            data-materno="<?= $usuario->materno?>"
                            data-correo="<?= $usuario->correo?>"
                            data-rol="<?= $usuario->rol?>"
                            data-pass="<?= $usuario->password?>"
                            onclick="modificarPaciente(event)"
                        >
                            <i class="uil uil-pen"></i>
                        </button>
                        <button type="button" class="button-borrar" data-bs-toggle="modal"
                            data-bs-target="#eliminarUsuario"
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

            <!-- MODAL MODIFICAR Usuario -->
            <div class="modal fade" id="modificarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modificar Usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="ctrlUsuario.php" method="POST">
                                <input type="hidden" id="modUsrId" name="modUsrId">
                                <input type="hidden" id="modUsrPass" name="modUsrPass">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="modUsrNombre" class="form-label">Nombres</label>
                                        <input type="text" class="form-control" name="modUsrNombre" id="modUsrNombre"
                                            aria-describedby="helpId" >
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6  mb-3">
                                        <label for="modUsrPaterno" class="form-label">Apellido Paterno</label>
                                        <input type="text" class="form-control" name="modUsrPaterno" id="modUsrPaterno"
                                            aria-describedby="helpId">
                                    </div>
                                    <div class="col-12 col-md-6  mb-3 ">
                                        <label for="modUsrMaterno" class="form-label">Apellido Materno</label>
                                        <input type="text" class="form-control" name="modUsrMaterno" id="modUsrMaterno"
                                            aria-describedby="helpId">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="modUsrCorreo" class="form-label">Correo</label>
                                    <input type="email" class="form-control" name="modUsrCorreo" id="modUsrCorreo"
                                        aria-describedby="helpId">
                                </div>

                                <label for="modUsrRol" class="form-label">Rol</label>
                                <select class="mb-3 form-select" name="modUsrRol" id="modUsrRol"
                                    aria-label="Default select example">
                                    <?php foreach ($listaRoles as $rol) { ?>
                                    <option value="<?= $rol->getId()?>">
                                        <?= $rol->getDescripcion()?>
                                    </option>
                                    <?php }?>
                                </select>

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" value="Modificar" name="btn" class="btn btn-primary">Modificar Paciente</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL ELIMINAR USUARIO-->
            <div class="modal fade" id="eliminarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="ctrlUsuario.php" method="POST">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Paciente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden"  name="elimUsrId" id="elimUsrId">
                                <p>¿Esta seguro de eliminar al paciente <span id="nombreUsuario"></span>?</p>
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

            document.getElementById('nombreUsuario').innerHTML = nombre;
            document.getElementById('elimUsrId').value = id;
        }

        const modificarPaciente= e =>{
            const id = document.getElementById('modUsrId');
            const nombre = document.getElementById('modUsrNombre');
            const correo = document.getElementById('modUsrCorreo');
            const paterno = document.getElementById('modUsrPaterno');
            const materno = document.getElementById('modUsrMaterno');
            const rol = document.getElementById('modUsrRol');
            const pass = document.getElementById('modUsrPass');



            id.value = e.currentTarget.dataset.id;
            nombre.value = e.currentTarget.dataset.nombres;
            correo.value = e.currentTarget.dataset.correo;
            paterno.value = e.currentTarget.dataset.paterno;
            materno.value = e.currentTarget.dataset.materno;
            rol.value = e.currentTarget.dataset.rol;
            pass.value = e.currentTarget.dataset.pass;
        }
    </script>
</body>


</html>