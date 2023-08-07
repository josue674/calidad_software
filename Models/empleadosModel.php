<?php
include_once 'conexion.php';

function VerProvinciaModel()
{
    $instancia = Open();

    $sentencia = "CALL obtenerProvincia();";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}

function VerRolModel()
{
    $instancia = Open();

    $sentencia = "CALL obtenerRol();";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}

function VerDatosEmpleadosModel()
{
    $instancia = Open();

    $sentencia = "CALL VerDatosEmpleados();";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}

function InsertarEmpleadoModel(
    $correoElectronico,
    $identificacion,
    $nombre,
    $primerApellido,
    $segundoApellido,
    $salario,
    $fechaNacimiento,
    $horasLaborar,
    $telefono,
    $provincia,
    $canton,
    $distrito,
    $otrasSenales,
    $contasenna,
    $rol
) {
    $instancia = Open();

    $sentencia = "CALL InsertarEmpleado('$correoElectronico','$identificacion',
    '$nombre','$primerApellido','$segundoApellido','$salario',
    '$fechaNacimiento','$horasLaborar','$telefono','$provincia','$canton',
    '$distrito','$otrasSenales','$contasenna','$rol');";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}

function ActualizarEmpleadoModel(
    $idEmpleado,
    $correoElectronico,
    $identificacion,
    $nombre,
    $primerApellido,
    $segundoApellido,
    $salario,
    $fechaNacimiento,
    $horasLaborar,
    $telefono,
    $provincia,
    $canton,
    $distrito,
    $otrasSenales,
    $contasenna,    
    $rol
) {
    $instancia = Open();

    $sentencia = "CALL ActualizarEmpleado('$idEmpleado','$correoElectronico','$identificacion',
    '$nombre','$primerApellido','$segundoApellido','$salario',
    '$fechaNacimiento','$horasLaborar','$telefono','$provincia','$canton',
    '$distrito','$otrasSenales','$contasenna','$rol');";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}

function VerificarExisteCorreoModel($correoElectronico)
{
    $instancia = Open();

    $sentencia = "CALL VerificacionCorreo('$correoElectronico');";
    $resultado = $instancia -> query($sentencia);
    Close($instancia);
    return $resultado;        
}

function VerDatosEmpleadoModel($idEmpleado)
{
    $instancia = Open();

    $sentencia = "CALL VerDatosEmpleado($idEmpleado);";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}

function EliminarEmpleadoModel($consecutivoEmpleado)
{
    $instancia = Open();

    $sentencia = "CALL EliminarEmpleado('$consecutivoEmpleado');";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}

function ActivarEmpleadoModel($consecutivoEmpleado)
{
    $instancia = Open();

    $sentencia = "CALL ActivarEmpleado('$consecutivoEmpleado');";
    $resultado = $instancia->query($sentencia);

    Close($instancia);
    return $resultado;
}
