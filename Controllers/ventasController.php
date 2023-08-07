<?php
include_once '../Models/ventasModel.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["btnBuscarCliente"])) {

    $identificacion = $_POST['identificacion'];
    if ($_SESSION["Factura"] == "") {
        $resultado = BuscarDatosClienteModel($identificacion);
        if ($resultado->num_rows > 0) {
            $datosResultado = mysqli_fetch_array($resultado);
            $_SESSION["Identificacion"] = $identificacion;
            $_SESSION["CorreoCliente"] = $datosResultado["Correo"];
            $_SESSION["Nombre"] = $datosResultado["Nombre"];
            $_SESSION["Telfono"] = $datosResultado["telefono"];
            $_SESSION["idCliente"] = $datosResultado["idCliente"];
        } else {
            $_SESSION["Identificacion"] = "";
            $_SESSION["CorreoCliente"] = "";
            $_SESSION["Nombre"] = "";
            $_SESSION["Telfono"] = "";
            $_SESSION["idCliente"] = "";
            $_SESSION["Factura"] = "";
            header("location: ../Views/clientesinformacion.php");
        }
    }
}

function BuscarProducto($nombreProducto)
{
    $resultado = BuscarProductoModel($nombreProducto);
    if ($resultado->num_rows > 0) {
        while ($datosResultado = mysqli_fetch_array($resultado)) {
            echo "<tr>";
            echo "<td>" . $datosResultado["nombre_Producto"] . "</td>";
            echo "<td>" . $datosResultado["cantidad_Disponible"] . "</td>";
            echo "<td>" . "$" . $datosResultado["precio_Venta"] . "</td>";
            if ($datosResultado["cantidad_Disponible"] > 0) {
                echo "<td> <input type='number' min=1 max=" . $datosResultado["cantidad_Disponible"] . " class='form-control' id='cantidad" . $datosResultado["id_Producto"] . "'
            name='cantidad" . $datosResultado["id_Producto"] . "' value=1> </td>";
                echo "<td>" . "<a href='#' onclick='AgregarProducto(" . $datosResultado["id_Producto"] . "," . $datosResultado["cantidad_Disponible"] . ");'><i class='fa fa-plus'></i></a>" . "</td>";
            } else {
                echo "<td> <input type='number' disabled  class='form-control' value=0> </td>";
                echo "<td>" . "<a ><i class='fa fa-'></i></a>" . "</td>";
            }
            echo "</tr>";
        }
    }
}

function TotalFactura()
{
    $resultado = VerTotalFacturaModel($_SESSION["Factura"]);
    $total = 0;
    if ($resultado->num_rows > 0) {
        while ($datosResultado = mysqli_fetch_array($resultado)) {
            $total = $total + ($datosResultado["precio_Venta"] * $datosResultado["cantidad_Venta"]);
        }
    }
    return $total;
}

if (isset($_POST["AgregarProducto"])) {
    if ($_SESSION["Factura"] == "") {
        $resultadoFactura = CrearFacturaModel($_SESSION["idCliente"], $_SESSION["idEmpleado"],);
        if ($resultadoFactura > 0) {
            $_SESSION["Factura"] = $resultadoFactura;
        }
    }
    if ($_POST['cantidad'] <= $_POST['CantidadDisponible'] && $_POST['cantidad'] > 0) {
        $resultadoProducto = AgregarProductoModel($_POST['idProducto'], $_POST['cantidad'], $_SESSION["Factura"]);
        if ($resultadoProducto) {
            echo "ok";
        }
    }else
    {
        echo "Cantidad no disponible";
    }
}

if (isset($_POST["EliminarProducto"])) {

    $resultadoProducto = EliminarProductoModel($_POST['idProducto'], $_SESSION["Factura"], $_POST['Cantidad']);
    if ($resultadoProducto) {
        echo "ok";
    }
}

function VerDetalleFactura()
{
    $resultado = VerDetalleFacturaModel($_SESSION["Factura"]);
    if ($resultado->num_rows > 0) {
        return $resultado;
    } else {
        return null;
    }
}

function VerCompras()
{   
    $resultado = VerComprasModel();

    if($resultado -> num_rows > 0)
    {
        While($datosResultado = mysqli_fetch_array($resultado))
        {   
            echo "<tr>";
            echo "<td>" . $datosResultado["fecha_Factura"] . "</td>";
            echo "<td>" . $datosResultado["Cliente"] . "</td>";
            echo "<td>" . $datosResultado["Empleado"] . "</td>";
            echo "<td>" . "<a href='../Views/detalles.php?id_Compra=" . $datosResultado["id_Compra"] . "'>Ver Detalle</a> </td>";
            echo "</tr>";
        }
       
    }
}
    function VerDetalleCompra($idCompra)
{
    $resultado = VerDetalleCompraModel($idCompra);
    if ($resultado->num_rows > 0) {
        $Totalizado = 0;
        While($datosResultado = mysqli_fetch_array($resultado))
        {   
            $Totalizado += ($datosResultado["cantidad_Venta"] * $datosResultado["precio_Venta"]);
            echo "<tr>";
            echo "<td>" . $datosResultado["cantidad_Venta"] . "</td>";
            echo "<td>" . $datosResultado["nombre_Producto"] . "</td>";
            echo "<td>" . $datosResultado["precio_Venta"] . "</td>";
            echo "<td>" . $datosResultado["cantidad_Venta"] * $datosResultado["precio_Venta"] . "</td>";
            echo "</tr>";
        }
         
        echo "<tr>";
        echo "<td style='color:blue; text-align:right; font-weight:bold;' colspan='5'>Total a Pagar      $ " . number_format($Totalizado,2) . "</td>";
        echo "</tr>";
    } else {
        return null;
    }
}

