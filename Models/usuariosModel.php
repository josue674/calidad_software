<?php
include_once 'conexion.php';

function VerDatosUsuariosModel($correoElectronico, $tipoUsuario)
{
    $instancia = Open();

    $sentencia = "CALL VerDatosUsuarios('$correoElectronico', $tipoUsuario);";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}

function VerificarExisteCorreoModel($correoElectronico)
{
    $instancia = Open();

    $sentencia = "CALL VerificarExisteCorreo('$correoElectronico');";
    $resultado = $instancia -> query($sentencia);
    Close($instancia);
    return $resultado;        
}

function ElimiarUsuarioModel($consecutivoUsuario)
{
    $instancia = Open();

    $sentencia = "CALL ElimiarUsuario('$consecutivoUsuario');";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}

FUNCTION ActivarUsuarioModel($consecutivoUsuario)
{
    $instancia = Open();

    $sentencia = "CALL ActivarUsuario('$consecutivoUsuario');";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}

function RegistrarCuentaModel($correoElectronico, $contrasenna)
{
    $instancia = Open();

    $tipoUsuarioCliente = 2;

    $sentencia = "CALL RegistrarCuenta('$correoElectronico','$contrasenna',$tipoUsuarioCliente);";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}

function VerDatosUsuarioModel($consecutivoUsuario)
{
    $instancia = Open();

    $sentencia = "CALL VerDatosUsuario($consecutivoUsuario);";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;   
}

function VerPerfilesModel()
{
    $instancia = Open();

    $sentencia = "CALL VerPerfiles();";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;   
}


?>