<?php
include_once "../Models/DireccionModel.php";


if(isset($_GET['opcionSeleccionada'])) {
    $opcionSeleccionada = $_GET['opcionSeleccionada'];
    // Aquí podrías realizar cualquier proceso o consulta que necesites para obtener los datos que deseas mostrar en el segundo select
    $resultado = obtenerCanton($opcionSeleccionada);
   
    if($resultado -> num_rows > 0)
    {
        $cantones = array();
        $cantones[] = array(
            'id' => '',
            'nombre' => 'Seleccione un cantón'
        );
        while($fila = $resultado -> fetch_assoc())
        {
            $cantones[] = array(
                'id' => $fila['id_Canton'],
                'nombre' => $fila['Canton']
            );
        }
        echo json_encode($cantones);
    }
    else
    {
        echo 'no';
    }
}
if(isset($_GET['opcionSeleccionada2'])) {
    $opcionSeleccionada = $_GET['opcionSeleccionada2'];
    // Aquí podrías realizar cualquier proceso o consulta que necesites para obtener los datos que deseas mostrar en el segundo select
    $resultado = obtenerDistrito($opcionSeleccionada);
   
    if($resultado -> num_rows > 0)
    {
        $distrito = array();
        $distrito[] = array(
            'id' => '',
            'nombre' => 'Seleccione un distrito'
        );
        while($fila = $resultado -> fetch_assoc())
        {
            $distrito[] = array(
                'id' => $fila['id_Distrito'],
                'nombre' => $fila['Distrito']
            );
        }
        echo json_encode($distrito);
    }
    else
    {
        echo 'no';
    }
}
?>