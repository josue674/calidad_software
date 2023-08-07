<?php
include_once '../Models/clientesModel.php';
include_once 'EmailController.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["btnInsertarCliente"])) {
    $correoElectronico = $_POST['correoElectronico'];
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $primerApellido = $_POST['primerApellido'];
    $segundoApellido = $_POST['segundoApellido'];
    $telefono = $_POST['telefono'];
    $provincia = $_POST['provincia'];
    $canton = $_POST['canton'];
    $distrito = $_POST['distrito'];
    $otrasSenales = $_POST['otrasSenales'];
    $resultado = InsertarCleinteModel(
        $correoElectronico,
        $identificacion,
        $nombre,
        $primerApellido,
        $segundoApellido,
        $telefono,
        $provincia,
        $canton,
        $distrito,
        $otrasSenales
    );

    if ($resultado) {
        header("location: ../../Views/clientesInformacion.php");
    }
}

if (isset($_POST["btnActualizarCliente"])) {
    $idCliente = $_POST['idCliente'];
    $correoElectronico = $_POST['correoElectronico'];
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $primerApellido = $_POST['primerApellido'];
    $segundoApellido = $_POST['segundoApellido'];
    $telefono = $_POST['telefono'];
    $provincia = $_POST['provincia'];
    $canton = $_POST['canton'];
    $distrito = $_POST['distrito'];
    $otrasSenales = $_POST['otrasSenales'];
    $resultado = ActualizarCleinteModel(
        $idCliente,
        $correoElectronico,
        $identificacion,
        $nombre,
        $primerApellido,
        $segundoApellido,
        $telefono,
        $provincia,
        $canton,
        $distrito,
        $otrasSenales
    );
    echo $resultado;
    if ($resultado) {
        header("location: ../../Views/clientesInformacion.php");
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

function VerDatosClientes()
{
    $resultado = VerDatosClientesModel();
    if ($resultado->num_rows > 0) {
        while ($datosResultado = mysqli_fetch_array($resultado)) {
            echo "<tr>";
            echo "<td>" . $datosResultado["identificacion"] . "</td>";
            echo "<td>" . $datosResultado["Nombre"] . "</td>";
            echo "<td>" . $datosResultado["PrimerApellido"] . "</td>";
            echo "<td>" . $datosResultado["SegundApellido"] . "</td>";
            echo "<td>" . $datosResultado["Correo"] . "</td>";
            echo "<td>" . $datosResultado["telefono"] . "</td>";            
            echo "<td>" . $datosResultado["DescEstado"] . "</td>";

            if ($datosResultado["DescEstado"] == "Activo") {

                echo "<td>" . "<a href='../Views/clientesActualizar.php?datosCliente=" . $datosResultado["idCliente"] . "'><i class='fa fa-pen'></i></a> | 
                    <a href='#' onclick='EliminarCleinte(" . $datosResultado["idCliente"] . ");'><i class='fa fa-trash'></i></a>" . "</td>";
                    
            } else {
                echo "<td>" . "<a href='../Views/clientesActualizar.php?q=" . $datosResultado["idCliente"] . "'><i class='fa fa-pen'></i></a> | 
                    <a href='#' onclick='ActivarCliente(" . $datosResultado["idCliente"] . ");'><i class='fa fa-check'></i></a>" . "</td>";
            }

            echo "</tr>";
        }
    }
}

function VerDatosCliente($idCliente)
{
    $resultado = VerDatosClienteModel($idCliente);
    if ($resultado->num_rows > 0) {
        return mysqli_fetch_array($resultado);
    }
}
if (isset($_POST["ElimiarCliente"])) {

    $resultadp = ElimiarClienteModel($_POST['consecutivoCliente']);

    if ($resultadp) {
        echo "OK";
    }
}

if (isset($_POST["ActivarCliente"])) {

    $resultadp = ActivarClienteModel($_POST['consecutivoCliente']);

    if ($resultadp) {
        echo "OK";
    }
}




