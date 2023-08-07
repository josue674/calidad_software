<?php
include_once 'conexion.php';

function BuscarDatosClienteModel($idCleinte)
{
    $instancia = Open();

    $sentencia = "CALL BuscarDatosCliente('$idCleinte');";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}

function BuscarProductoModel($nombreProducto)
{
    $instancia = Open();

    $sentencia = "CALL BuscarProducto('$nombreProducto');";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}

function AgregarProductoModel($idProducto, $Cantidad, $idFaltura)
{
    $instancia = Open();
    $sentencia = "CALL AgregarProducto('$idProducto','$idFaltura','$Cantidad');";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}

function CrearFacturaModel($idCliente, $idEmpleado)
{
    $instancia = Open();

    $instancia->query("CALL CrearFactura('$idCliente','$idEmpleado',@idFactura);");
    $resultado = $instancia->query("SELECT @idFactura;");
    $datosResultado = mysqli_fetch_array($resultado);
    $pidFactura = $datosResultado["@idFactura"];

    Close($instancia);
    return $pidFactura;
}

function VerDetalleFacturaModel($idFactura)
{
    $instancia = Open();

    $sentencia = "CALL VerDetalleFactura('$idFactura');";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}

function VerTotalFacturaModel($idFactura)
{
    $instancia = Open();

    $sentencia = "CALL VerDetalleFactura('$idFactura');";
     $resultado = $instancia->query($sentencia);

   Close($instancia);
    return $resultado;
}

function EliminarCarritoTotalModel($idFactura){
    $instancia = Open();

    $sentencia = "CALL EliminarFactura('$idFactura');";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}

function EliminarProductoModel($idProducto,$Cantidad,$Factura){
    $instancia = Open();

    $sentencia = "CALL EliminarProducto('$idProducto','$Cantidad','$Factura');";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}
function VerComprasModel()
{
    $instancia = Open();

    $sentencia = "CALL VerCompras();";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}
function VerDetalleCompraModel($idCompra)
{
    $instancia = Open();

    $sentencia = "CALL VerDetalleCompra('$idCompra');";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}

