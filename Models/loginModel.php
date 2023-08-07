<?php
include_once 'conexion.php';

function ValidarInicioSesionModel($correoElectronico, $contrasenna)
{
    $instancia = Open();

    $sentencia = "CALL ValidacionSesion('$correoElectronico','$contrasenna');";
    $resultado = $instancia -> query($sentencia);

    Close($instancia);
    return $resultado;    
}

?>