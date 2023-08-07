<?php
include_once 'utilitarios.php';
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

                <div class="container-fluid d-flex justify-content-center ">
                    <div class="w-50  ">
                        <form action="" method="post" class="user " enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="row ">
                                    <div class="col">
                                        <input type="email" class="form-control" placeholder="Enter email" 
                                        id="correoElectronico" name="correoElectronico" onblur='HabilitarBoton()' >
                                    </div>
                                    <div class="col  ">
                                        <input type="file" class="form-control" id="archivoAdjunto" 
                                         name="archivoAdjunto" oninput="HabilitarBoton()"
                                        >
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary btn-user btn-block " disabled value="Notificar" 
                             id="btnNotificar" name="btnNotificar">
                        </form>
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
    <script src="js/funcionesNotificar.js"></script>
</body>

</html>