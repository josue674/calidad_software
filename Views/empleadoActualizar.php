<?php
include_once 'utilitarios.php';
include_once '../Controllers/empleadosController.php';
BloquearPantallasBodeguero();
BloquearPantallasCajero();

$resultado = VerDatosEmpleado($_GET["datosEmpleado"]);
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
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Actualizar Datos Empleado</h1>
                                </div>

                                <form action="" method="post" class="user">
                                    <input type="hidden" id="idEmpleado" name="idEmpleado" value="<?php echo $resultado["id_Empleado"] ?>">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="number" class="form-control " id="identificacion" name="identificacion" minlength="9" maxlenght="9" placeholder="Identificación" disabled value="<?php echo $resultado["num_identificacion"] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control " id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $resultado["Nombre"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control " id="primerApellido" name="primerApellido" placeholder="Primer Apellido" value="<?php echo $resultado["PrimerApellido"] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control " id="segundoApellido" name="segundoApellido" placeholder="Segundo Apellido" value="<?php echo $resultado["SegundoApellido"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="number" class="form-control " id="Salario" name="Salario" placeholder="Salario" value="<?php echo $resultado["Salario"] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="date" class="form-control " id="fechaNacimeinto" name="fechaNacimeinto" placeholder="Fecha de nacimiento" value="<?php echo $resultado["fecha_Nacimiento"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="number" class="form-control " id="horasLaborar" name="horasLaborar" placeholder="Horas laborales" value="<?php echo $resultado["horas_labor"] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control " id="correoElectronico" name="correoElectronico" placeholder="Correo Electrónico" value="<?php echo $resultado["correo"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control " id="contasenna" name="contasenna" placeholder="Contraseña" value="">
                                        </div>
                                        <div class="col-sm-6">
                                            <select id="rol" name="rol" class="form-control ">
                                            <option value=0 text=""><?php echo $resultado["nombre_Rol"]?></option>
                                            <?php 
                                            VerRol();
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="number" class="form-control " id="telefono" name="telefono" placeholder="Telefono" value="<?php echo $resultado["telefono"] ?>">
                                        </div>
                                        <div class="col-sm-6">

                                            <select id="provincia" name="provincia" onchange="cargarDatos()" class="form-control ">
                                                <option value=0 text=""><?php echo $resultado["Provincia"] ?></option>
                                                <?php
                                                VerProvincia();
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <select id="canton" name="canton" onchange="cargarDatos2()" class="form-control ">
                                            <option value=0 text=""><?php echo $resultado["Canton"] ?></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <select id="distrito" name="distrito" class="form-control ">
                                            <option value=0 text=""><?php echo $resultado["Distrito"] ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control " id="otrasSenales" name="otrasSenales" placeholder="Otras senales" value="<?php echo $resultado["Otras_senas"] ?>">
                                    </div>
                                    <br />
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Actualizar" id="btnActualizarEmpleado" name="btnActualizarEmpleado">
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
    <script src="js/FuncionesDireccion.js"></script>
</body>

</html>
