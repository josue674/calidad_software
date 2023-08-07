<?php
include_once '../Models/proveedorModel.php';
include_once 'EmailController.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["btnInsertarProveedor"])) {
    $correoElectronico = $_POST['correoElectronico'];
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $provincia = $_POST['provincia'];
    $canton = $_POST['canton'];
    $distrito = $_POST['distrito'];
    $otrasSenales = $_POST['otrasSenales'];
    $resultado = InsertarProveedorModel(
        $correoElectronico,
        $identificacion,
        $nombre,
        $telefono,
        $provincia,
        $canton,
        $distrito,
        $otrasSenales
    );

    if ($resultado) {
        header("location: ../../Views/proveedorInformacion.php");
    }
}

if (isset($_POST["btnActualizarProveedor"])) {
    $idProveedor = $_POST['id_Proveedor'];
    $correoElectronico = $_POST['correoElectronico'];
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $provincia = $_POST['provincia'];
    $canton = $_POST['canton'];
    $distrito = $_POST['distrito'];
    $otrasSenales = $_POST['otrasSenales'];
    $resultado = ActualizarProveedorModel(
        $idProveedor,
        $correoElectronico,
        $identificacion,
        $nombre,
        $telefono,
        $provincia,
        $canton,
        $distrito,
        $otrasSenales
    );
     echo $resultado;
    if ($resultado) {
        header("location: ../../Views/proveedorInformacion.php");
    }
}

function VerProvincia()
{
    $resultado = VerProvinciaModel();
    if ($resultado->num_rows > 0) {
        while ($datosResultado = mysqli_fetch_array($resultado)) {
            echo "<option value=" . $datosResultado["id_Provincia"] . ">" . $datosResultado["Provincia"] . "</option>";
        }
    }
}

function VerDatosProveedores()
{
    $resultado = VerDatosProveedoresModel();
    if ($resultado->num_rows > 0) {
        while ($datosResultado = mysqli_fetch_array($resultado)) {
            echo "<tr>";
            echo "<td>" . $datosResultado["nombreProveedor"] . "</td>";
            echo "<td>" . $datosResultado["identificacion"] . "</td>";
            echo "<td>" . $datosResultado["correo"] . "</td>";
            echo "<td>" . $datosResultado["telefono"] . "</td>";            
            echo "<td>" . $datosResultado["DescEstado"] . "</td>";

            if ($datosResultado["DescEstado"] == "Activo") {

                echo "<td>" . "<a href='../Views/proveedorActualizar.php?datosProveedor=" . $datosResultado["id_Proveedor"] . "'><i class='fa fa-pen'></i></a> | 
                    <a href='#' onclick='EliminarProveedor(" . $datosResultado["id_Proveedor"] . ");'><i class='fa fa-trash'></a>" . "</td>";
            } else {
                echo "<td>" . "<a href='../Views/proveedorActualizar.php?datosProveedor=" . $datosResultado["id_Proveedor"] . "'><i class='fa fa-pen'></a> | 
                    <a href='#' onclick='ActivarProveedor(" . $datosResultado["id_Proveedor"] . ");'><i class='fa fa-check'></i></a>" . "</td>";
            }

            echo "</tr>";
        }
    }
}

function VerDatosProveedor($idProveedor)
{
    $resultado = VerDatosProveedorModel($idProveedor);
    if ($resultado->num_rows > 0) {
        return mysqli_fetch_array($resultado);
    }
}
if (isset($_POST["EliminarProveedor"])) {

    $resultadp = EliminarProveedorModel($_POST['consecutivoProveedor']);

    if ($resultadp) {
        echo "OK";
    }
}

if (isset($_POST["ActivarProveedor"])) {

    $resultadp = ActivarProveedorModel($_POST['consecutivoProveedor']);

    if ($resultadp) {
        echo "OK";
    }
}




