<?php
include_once 'conexion.php';

function VerProveedorModel()
{
    $instancia = Open();

    $sentencia = "CALL obtenerProveedor();";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}


function VerDatosProductosModel()
{
    $instancia = Open();

    $sentencia = "CALL VerDatosProductos();";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}

function InsertarProductoeModel(
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
) {
    $instancia = Open();

    $sentencia = "CALL InsertarProducto(
    '$nombreProducto',
    '$cantidad',
    '$precio',
    '$descProducto',
    '$fechaProduccion',
    '$fechaVencimiento',
    '$marca',
    '$categoria',
    '$descCategoria',
    '$proveedor');";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}

function ActualizarProductoModel(
    $idProducto,
    $nombreProducto,
    $cantidad,
    $precio,
    $proveedor,
    $descProducto,
) {
    $instancia = Open();

    $sentencia = "CALL ActualizarProducto(
        '$idProducto',
        '$nombreProducto',
        '$cantidad',
        '$precio',
        '$descProducto',
        '$proveedor'
);";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}

function VerDatosProcutoModel($idProducto)
{
    $instancia = Open();

    $sentencia = "CALL VerDatosProducto($idProducto);";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}
