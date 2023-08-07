<?php
include_once 'utilitarios.php';
include_once '../Controllers/proveedorController.php';

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
                                    <h1 class="h4 text-gray-900 mb-4">Agregar Nuevo Proveedor</h1>
                                </div>
                                <form action="" method="post" class="user">
                                    <input type="hidden" id="consecutivo" name="consecutivo" value="">
                                    <div class="form-group">
                                        <input type="email" class="form-control " id="correoElectronico" name="correoElectronico" placeholder="Correo Electrónico" value="">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control " id="identificacion" name="identificacion" minlength="9" maxlenght="10" placeholder="Identificación" value="">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control " id="nombre" name="nombre" placeholder="Nombre" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="number" class="form-control " id="telefono" name="telefono" placeholder="Teléfono" value="">
                                        </div>
                                        <div class="col-sm-6">

                                            <select id="provincia" name="provincia" onchange="cargarDatos()" class="form-control ">
                                                <option value="" text="">Seleccione una Provincia</option>
                                                <?php
                                                     VerProvincia();
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <select id="canton" name="canton" onchange="cargarDatos2()" class="form-control ">
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select id="distrito" name="distrito" class="form-control ">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control " id="otrasSenales" name="otrasSenales" placeholder="Otras señas" value="">
                                    </div>
                                    <br />
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Insertar" id="btnInsertarProveedor" name="btnInsertarProveedor">
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
    <script src="js/funcionesUsuario.js"></script>
    <script src="js/FuncionesDireccion.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>