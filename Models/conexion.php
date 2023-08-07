<?php

function Open()
{
    $servidor = "127.0.0.1:3307";
    $usuario = "root";
    $contrasenna = "";
    $baseDatos = "proyecto_supermercado_la_amistad";

    return mysqli_connect($servidor, $usuario, $contrasenna, $baseDatos);
}

function Close($instancia)
{
    mysqli_close($instancia);
}

?>