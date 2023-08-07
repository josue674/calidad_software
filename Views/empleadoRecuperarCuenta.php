<?php
include_once 'utilitarios.php';
include_once '../Controllers/empleadosController.php';
BloquearPantallasBodeguero();
BloquearPantallasCajero();
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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        mostrarMenu();
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <?php
                    MostrarNombreUsuario();
                    ?>
                </nav>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Recuperar Cuenta</h1>
                                </div>
                                <form action="" method="post" class="user">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="correoElectronico" name="correoElectronico" required placeholder="Correo Electrónico" onblur="HabilitarBotonRecuperacion();">
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Recuperar" disabled id="btnRecuperarCuenta" name="btnRecuperarCuenta">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            mostrarFooter();
            ?>

        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/funcionesEmpleado.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
