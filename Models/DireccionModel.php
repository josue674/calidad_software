<?php
include_once 'conexion.php';

function obtenerCanton($Provincia) {
    $instancia = Open();
    
    // Llamada al procedimiento almacenado        
        $consulta = "CALL obtenerCanton('$Provincia');";
        $resultado = $instancia->query($consulta);

    Close($instancia);
    return $resultado;
}
function obtenerDistrito($id_Distrito) {
    $instancia = Open();
    
    // Llamada al procedimiento almacenado
    $consulta = "CALL obtenerDistrito($id_Distrito)";
    $resultado = $instancia->query($consulta);

    Close($instancia);
    return $resultado;
}
?>