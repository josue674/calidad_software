<?php
include_once 'conexion.php';

function VerProvinciaModel()
{
    $instancia = Open();

    $sentencia = "CALL obtenerProvincia();";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}


function VerDatosProveedoresModel()
{
    $instancia = Open();

    $sentencia = "CALL VerDatosProveedores();";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}

function InsertarProveedorModel($correoElectronico,
$identificacion,$nombre,$telefono,
$provincia,$canton,$distrito,$otrasSenales)
{
    $instancia = Open();

    $sentencia = "CALL InsertarProveedor('$correoElectronico','$identificacion',
    '$nombre','$telefono','$provincia','$canton',
    '$distrito','$otrasSenales');";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}

function ActualizarProveedorModel($consecutivoProveedor,$correoElectronico,
$identificacion,$nombre,$telefono,
$provincia,$canton,$distrito,$otrasSenales)
{
    $instancia = Open();

    $sentencia = "CALL ActualizarProveedor('$consecutivoProveedor','$correoElectronico','$identificacion',
    '$nombre','$telefono','$provincia','$canton',
    '$distrito','$otrasSenales');";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}

function VerDatosProveedorModel($consecutivoProveedor)
{
    $instancia = Open();

    $sentencia = "CALL VerDatosProveedor($consecutivoProveedor);";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;   
}

function EliminarProveedorModel($consecutivoProveedor)
{
    $instancia = Open();

    $sentencia = "CALL ElimiarProveedor('$consecutivoProveedor');";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}

FUNCTION ActivarProveedorModel($consecutivoProveedor)
{
    $instancia = Open();

    $sentencia = "CALL ActivarProveedor('$consecutivoProveedor');";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}


