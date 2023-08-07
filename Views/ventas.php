<?php
include_once 'utilitarios.php';
include_once '../Controllers/ventasController.php';
$resultado = $_GET["nombreProducto"];
$total = TotalFactura();
$VerDetalleFactura = VerDetalleFactura();
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
    <link href="css/btn.css" rel="stylesheet">
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



                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-lg-7" style="height: 650px;">
                            <!-- Circle Buttons -->
                            <div class="card shadow mb-4" style="height: 30%;">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Cliente</h6>
                                    <form action="" method="post" class="pr-3">
                                        <div class="row  ">
                                            <div class="col-9">
                                                <input type="number" class="form-control form-control-user" id="identificacion" name="identificacion" placeholder="<?php echo $_SESSION['Identificacion'] ?>">
                                            </div>
                                            <div class="col-3  ">
                                                <input type="submit" class="btn btn-primary  " value="Buscar" id="btnBuscarCliente" name="btnBuscarCliente">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" id="consecutivo" name="consecutivo" value="<?php echo $_SESSION['idCliente'] ?>">
                                    <div class="form-group">
                                        <input type="email" class="form-control " id="correoElectronico" name="correoElectronico" placeholder="Correo Electrónico" value="<?php echo $_SESSION['CorreoCliente'] ?>">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="number" class="form-control " id="telefono" name="telefono" placeholder="Teléfono" value="<?php echo $_SESSION['Telfono'] ?>">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control " id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $_SESSION['Nombre'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Brand Buttons -->
                            <div class="card shadow " style="height: 65%;">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Producto</h6>
                                    <div class="row  ">
                                        <div class="col-7">
                                            <input type="text" class="form-control form-control-user" id="nombreProducto" name="nombreProducto" placeholder="Producto" onkeyup="actualizarEnlace()">
                                        </div>
                                        <div class="col-3  ">
                                            <button type="submit" class="btn btn-primary  " value="Buscar" id="btnProducto" name="btnProducto">
                                                <a href='' id="enlace" class="input-like-btn">Buscar</a>
                                            </button>
                                        </div>
                                        <div class="col-2  ">
                                            <button type="submit" class="btn btn-primary  " value="Buscar" id="btnProducto" name="btnProducto">
                                                <a href='../Views/ventas.php?nombreProducto=' id="enlace" class="reload-icon">&#x21bb;</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="overflow-y: scroll;">
                                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 70%;">Articulo</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 10%">Disponible</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%">Precio</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 10%">Agregar</th>
                                                <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 2%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           BuscarProducto($resultado);
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <?php
                            $CarritoProducto = array();
                             echo "<div class='card shadow ' style='height: 640px;'>";
                             echo "<div class='card-header py-3'>";
                             echo " <h6 class='m-0 font-weight-bold text-primary'>Carrito</h6>";
                             echo "</div>";
                             echo " <div class='card-body '>";
                             echo "      <table class='table table-bordered dataTable' id='dataTable' width='100%' cellspacing='0' role='grid' aria-describedby='dataTable_info' style='width: 100%;'>";
                             echo "         <thead>";
                             echo "             <tr role='row'>";
                             echo "                 <th class='sorting sorting_asc' tabindex='0' aria-controls='dataTable' rowspan='1' colspan='1' aria-sort='ascending' aria-label='Name: activate to sort column descending' style='width: 60%;'>Articulo</th>";
                             echo "                 <th class='sorting' tabindex='0' aria-controls='dataTable' rowspan='1' colspan='1' aria-label='Office: activate to sort column ascending' style='width: 30%;'>Precio</th>";
                             echo "                 <th class='sorting' tabindex='0' aria-controls='dataTable' rowspan='1' colspan='1' aria-label='Position: activate to sort column ascending' style='width: 10%;''></th>";
                             echo "              </tr>";
                             echo "          </thead>";
                             echo "          <tbody>";
                                        if ($VerDetalleFactura != null) {
                                            
                                            while ($datosResultado = mysqli_fetch_array($VerDetalleFactura)) {
                                                echo "<tr>";
                                                echo "<td>" . $datosResultado["nombre_Producto"] . "</td>";
                                                echo "<td>" . "$" . $datosResultado["precio_Venta"] . "</td>";
                                                echo "<td>" . $datosResultado["cantidad_Venta"] . "</td>";
                                                echo "<td>" . "<a href='#' onclick='EliminarProducto(" . $datosResultado["id_Producto"] .",".$datosResultado["cantidad_Venta"]. ");'><i class='fa fa-trash'></i></a>" . "</td>";
                                                echo "</tr>";
                                                $CarritoProducto [] = array(
                                                    "id_Producto" => $datosResultado["id_Producto"],
                                                    "nombre_Producto" => $datosResultado["nombre_Producto"],
                                                    "precio_Venta" => $datosResultado["precio_Venta"],
                                                    "cantidad_Venta" => $datosResultado["cantidad_Venta"]
                                                );
                                             }
                                             $CarritoProductos[] = $CarritoProducto;
                                            }
                            echo "           </tbody>";
                            echo "      </table>";
                            echo "   </div>";
                            echo "   <div class='card-header py-3 d-flex flex-row align-items-center justify-content-between'>";
                            echo "       <h4 class='m-0 font-weight-bold text-primary'>Total</h4>";
                            echo "       <div >";
                            echo "           <h2 id='txtBuscar'>  "."$ ".$total." </h2>";
                            echo "       </div>";
                            echo "       </div>";
                            echo "       <button type='submit' class='btn btn-primary' value='Buscar' id='btnEnviarFactura' name='btnEnviarFactura'>";
                            echo "       <a href='#' class='input-like-btn' id='EnviarFactura'  onclick='EnviarFactura(". json_encode($CarritoProducto).");'>Facturar</a>";
                            echo "       </button>";
                            echo "       </div>";
                                    
                                    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="js/funcionesVentas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>