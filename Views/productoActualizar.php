<?php
include_once 'utilitarios.php';
include_once '../Controllers/productoController.php';

BloquearPantallasBodeguero();
BloquearPantallasCajero();

$resultado = VerDatosProducto($_GET["datosProducto"]);
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
                                    <h1 class="h4 text-gray-900 mb-4">Actualizar Producto</h1>
                                </div>

                                <form action="" method="post" class="user">
                                    <input type="hidden" id="idProducto" name="idProducto" value="<?php echo $resultado["id_Producto"] ?>">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control " id="nombreProducto" name="nombreProducto" placeholder="Producto" value="<?php echo $resultado["nombre_Producto"] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="number" class="form-control " id="cantidad" name="cantidad" placeholder="Cantidad" value="<?php echo $resultado["cantidad_Disponible"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control " id="precio" name="precio" placeholder="Precio" value="<?php echo $resultado["precio_Venta"] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="date" class="form-control " id="fechaProduccion" name="fechaProduccion" placeholder="Fecha Producción" value="<?php echo $resultado["Fecha_Produccion"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="date" class="form-control " id="fechaVencimiento" name="fechaVencimiento" placeholder="Fecha Vencimiento" value="<?php echo $resultado["Fecha_Vencimiento"] ?>">
                                        </div>
                                        <div class="col-sm-6">

                                            <select id="proveedor" name="proveedor" onchange="cargarDatos()" class="form-control ">
                                                <option value=<?php echo $resultado["id_Proveedor"] ?> text=""><?php echo $resultado["nombreProveedor"] ?></option>
                                                <?php
                                                VerProveedor();
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control " id="marca" name="marca" placeholder="Marca" value="<?php echo $resultado["nombre_Marca"] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control " id="categoria" name="categoria" placeholder="Categoría" value="<?php echo $resultado["nombre_Categoria"] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control " id="descProducto" name="descProducto" placeholder="Descripción Producto" value="<?php echo $resultado["descripcion"] ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control " id="descCategoria" name="descCategoria" placeholder="Descripcion Categoría" value="<?php echo $resultado["descripcion_Categoria"] ?>">
                                    </div>
                                    <br />
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Actualizar" id="btnActualizarProducto" name="btnActualizarProducto">
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