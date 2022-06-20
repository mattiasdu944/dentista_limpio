<?php
    require_once("vendor/autoload.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="./Css/bootstrap.min.css">
    <title>Login | admin</title>
</head>
<body>
    <main class="flex">
       <div class="login_formulario">
        <div class="formulario_container">
            <form action="validar.php" method="POST">
                <h2>Iniciar Sesion</h2>
                <div class="mb-3">
                    <label for="correoUsuario" class="form-label">Correo Electronico</label>
                    <input type="email" class="form-control" name="correoUsuario" id="correoUsuario" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="passUsuario" class="form-label">Contaseña</label>
                    <input type="password" class="form-control" name="passUsuario"id="passUsuario">
                </div>
                <button type="submit" name="btn" value="login" class="btn btn-primary">Submit</button>
            </form>
        </div>
       </div>
       <div class="login_publicidad">

       </div> 
    </main>    

    <style>
        *{
            margin: 0;
            padding: 0;
        }
        main{
            width: 100%;
            height: 100vh;
        }

        label{
            font-size: 1.2rem;
            color: white;
        }

        h2{
            font-size: 2.5rem;
            color: white;
            text-align: center;
        }

        .form-control{
            background-color: #c2c2c324;
            border:none;
            color: white;
        }
        .flex{
            display:flex;
        }

        .formulario_container{
            height: 100%;
            display: grid;
            align-items: center;
            padding: 0rem 2rem;
        }

        .login_formulario{
            background-color: rgb(22, 24, 34);
            height: 100%;
            width: 45rem;
            margin: 0 auto;
        }
        .login_publicidad{
            width: 100%;
            background-image: url('https://campus.open-bootcamp.com/a997aaf48fb80261.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100%;
        }

    </style>
</body>
</html>