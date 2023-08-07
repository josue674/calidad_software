<?php
include_once '../Models/productoModel.php';
include_once 'EmailController.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["btnInsertarProducto"])) {
    $nombreProducto = $_POST['nombreProducto'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $fechaProduccion = $_POST['fechaProduccion'];
    $fechaVencimiento = $_POST['fechaVencimiento'];
    $proveedor = $_POST['proveedor'];
    $marca = $_POST['marca'];
    $categoria = $_POST['categoria'];
    $descProducto = $_POST['descProducto'];
    $descCategoria = $_POST['descCategoria'];

    $resultado = InsertarProductoeModel(
        $nombreProducto,
        $cantidad,
        $precio,
        $fechaProduccion,
        $fechaVencimiento,
        $proveedor,
        $marca,
        $categoria,
        $descProducto,
        $descCategoria
    );

    if ($resultado) {
        header("location: ../../Views/productoInformacion.php");
    }
}

if (isset($_POST["btnActualizarProducto"])) {
    $idProducto = $_POST['idProducto'];
    $nombreProducto = $_POST['nombreProducto'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $fechaProduccion = $_POST['fechaProduccion'];
    $fechaVencimiento = $_POST['fechaVencimiento'];
    $proveedor = $_POST['proveedor'];
    $marca = $_POST['marca'];
    $categoria = $_POST['categoria'];
    $descProducto = $_POST['descProducto'];
    $descCategoria = $_POST['descCategoria'];
    $resultado = ActualizarProductoModel(
        $idProducto,
        $nombreProducto,
        $cantidad,
        $precio,
        $proveedor,
        $descProducto
    );
    if ($resultado) {
        header("location: ../../Views/productoInformacion.php");
    }
}

function VerProveedor()
{
    $resultado = VerProveedorModel();
    if ($resultado->num_rows > 0) {
        while ($datosResultado = mysqli_fetch_array($resultado)) {
            echo "<option value=" . $datosResultado["id_Proveedor"] . ">" . $datosResultado["nombreProveedor"] . "</option>";
        }
    }
}

function VerDatosProductos()
{
    $resultado = VerDatosProductosModel();
    if ($resultado->num_rows > 0) {
        while ($datosResultado = mysqli_fetch_array($resultado)) {
            echo "<tr>";
            echo "<td>" . $datosResultado["nombre_Producto"] . "</td>";
            echo "<td>" . $datosResultado["cantidad_Disponible"] . "</td>";
            echo "<td>" . "$" . $datosResultado["precio_Venta"] . "</td>";
            echo "<td>" . $datosResultado["Fecha_Produccion"] . "</td>";
            echo "<td>" . $datosResultado["Fecha_Vencimiento"] . "</td>";
            echo "<td>" . $datosResultado["nombreProveedor"] . "</td>";
            echo "<td>" . $datosResultado["nombre_Marca"] . "</td>";
            echo "<td>" . $datosResultado["nombre_Categoria"] . "</td>";

            echo "<td>" . "<a href='../Views/productoActualizar.php?datosProducto=" . $datosResultado["id_Producto"] . "'><i class='fa fa-pen'></a></td>";

            echo "</tr>";
        }
    }
}

function VerDatosProducto($idProducto)
{
    $resultado = VerDatosProcutoModel($idProducto);
    if ($resultado->num_rows > 0) {
        return mysqli_fetch_array($resultado);
    }
}
if (isset($_POST["ElimiarCliente"])) {

    $resultadp = ElimiarClienteModel($_POST['consecutivoCliente']);

    if ($resultadp) {
        echo "OK";
    }
}

if (isset($_POST["ActivarCliente"])) {

    $resultadp = ActivarClienteModel($_POST['consecutivoCliente']);

    if ($resultadp) {
        echo "OK";
    }
}
