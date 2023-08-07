<?php
include_once '../Controllers/usuariosController.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Supermercado La Amistad</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">

        <br /><br />

        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h2 class="h4 text-gray-900 mb-2">Ólvido su contraseña?</h2>
                                        <p class="mb-4">Entendemos lo que sucede. Por favor ingrese su correo electronico y
                                            le enviaremos un enlace para restablecer su contraseña!</p>
                                    </div>
                                    <form action="" method="post" class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="correoElectronico" name="correoElectronico" required placeholder="Correo Electrónico" onblur="HabilitarBotonRecuperacion();">
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Recuperar" disabled id="btnRecuperarCuenta" name="btnRecuperarCuenta">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="registroUsuarios.php">Crear una cuenta!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php"> Ya tienes una cuenta? Inicia Sesion!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/funcionesRecuperarUsuario.js"></script>
</body>

</html>