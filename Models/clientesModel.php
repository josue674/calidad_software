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


function VerDatosClientesModel()
{
    $instancia = Open();

    $sentencia = "CALL VerDatosClientes();";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}

function InsertarCleinteModel($correoElectronico,
$identificacion,$nombre,
$primerApellido,$segundoApellido,$telefono,
$provincia,$canton,$distrito,$otrasSenales)
{
    $instancia = Open();

    $sentencia = "CALL InsertarCleinte('$correoElectronico','$identificacion',
    '$nombre','$primerApellido','$segundoApellido','$telefono','$provincia','$canton',
    '$distrito','$otrasSenales');";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}

function ActualizarCleinteModel($idCliente,$correoElectronico,
$identificacion,$nombre,
$primerApellido,$segundoApellido,$telefono,
$provincia,$canton,$distrito,$otrasSenales)
{
    $instancia = Open();

    $sentencia = "CALL ActualizarCliente('$idCliente','$correoElectronico','$identificacion',
    '$nombre','$primerApellido','$segundoApellido','$telefono','$provincia','$canton',
    '$distrito','$otrasSenales');";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}

function VerDatosClienteModel($idCliente)
{
    $instancia = Open();

    $sentencia = "CALL VerDatosCliente($idCliente);";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;   
}

function ElimiarClienteModel($consecutivoCleinte)
{
    $instancia = Open();

    $sentencia = "CALL ElimiarCliente('$consecutivoCleinte');";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}

FUNCTION ActivarClienteModel($consecutivoCleinte)
{
    $instancia = Open();

    $sentencia = "CALL ActivarCliente('$consecutivoCleinte');";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}


