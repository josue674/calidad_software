<?php
include_once '../Models/empleadosModel.php';
include_once 'EmailController.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["btnInsertarEmpleado"])) {
    $correoElectronico = $_POST['correoElectronico'];
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $primerApellido = $_POST['primerApellido'];
    $segundoApellido = $_POST['segundoApellido'];
    $salario = $_POST['Salario'];
    $fechaNacimiento = $_POST['fechaNacimeinto'];
    $horasLaborar = $_POST['horasLaborar'];
    $telefono = $_POST['telefono'];
    $provincia = $_POST['provincia'];
    $canton = $_POST['canton'];
    $distrito = $_POST['distrito'];
    $otrasSenales = $_POST['otrasSenales'];
    $contasenna = $_POST['contasenna'];
    $rol = $_POST['rol'];
    $resultado = InsertarEmpleadoModel(
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
    );

    if ($resultado) {
        header("location: ../../Views/empleadoInformacion.php");
    }
}

if (isset($_POST["btnActualizarEmpleado"])) {
    $idEmpleado = $_POST['idEmpleado'];
    $correoElectronico = $_POST['correoElectronico'];
    $identificacion = $_POST['identificacion'];
    $nombre = $_POST['nombre'];
    $primerApellido = $_POST['primerApellido'];
    $segundoApellido = $_POST['segundoApellido'];
    $salario = $_POST['Salario'];
    $fechaNacimiento = $_POST['fechaNacimeinto'];
    $horasLaborar = $_POST['horasLaborar'];
    $telefono = $_POST['telefono'];
    $provincia = $_POST['provincia'];
    $canton = $_POST['canton'];
    $distrito = $_POST['distrito'];
    $otrasSenales = $_POST['otrasSenales'];
    $contasenna = $_POST['contasenna'];
    $rol = $_POST['rol'];
    $resultado = ActualizarEmpleadoModel(
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
    );
     echo $resultado;
    if ($resultado) {
        header("location: ../../Views/empleadoInformacion.php");
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

function VerRol()
{
    $resultado = VerRolModel();
    if ($resultado->num_rows > 0) {
        while ($datosResultado = mysqli_fetch_array($resultado)) {
            echo "<option value=" . $datosResultado["id_usuario_Rol"] . ">" . $datosResultado["nombre_rol"] . "</option>";
        }
    }
}

function VerDatosEmpleados()
{
    $resultado = VerDatosEmpleadosModel();
    if ($resultado->num_rows > 0) {
        while ($datosResultado = mysqli_fetch_array($resultado)) {
            echo "<tr>";
            echo "<td>" . $datosResultado["num_identificacion"] . "</td>";
            echo "<td>" . $datosResultado["Nombre"] . "</td>";
            echo "<td>" . $datosResultado["correo"] . "</td>";
            echo "<td>" . $datosResultado["telefono"] . "</td>";  
            echo "<td>" . $datosResultado["nombre_Rol"] . "</td>";            
            echo "<td>" . $datosResultado["DescEstado"] . "</td>";

            if ($datosResultado["DescEstado"] == "Activo") {
                if($_SESSION["idEmpleado"] != $datosResultado["id_Empleado"]){

                    echo "<td>" . "<a href='../Views/empleadoActualizar.php?datosEmpleado=" . $datosResultado["id_Empleado"] . "'><i class='fa fa-pen'></i></a> | 
                    <a href='#' onclick='EliminarEmpleado(" . $datosResultado["id_Empleado"] . ");'><i class='fa fa-trash'></a>" . "</td>";
                }else {
                    // echo "<td>" . "<a href='../Views/empleadoActualizar.php?datosEmpleado=" . $datosResultado["id_Empleado"] . "'><i class='fa fa-pen'></a> </td>";
                }
            } else {
                    echo "<td>" . "<a href='../Views/empleadoActualizar.php?datosEmpleado=" . $datosResultado["id_Empleado"] . "'><i class='fa fa-pen'></i></a> | 
                    <a href='#' onclick='ActivarEmpleado(" . $datosResultado["id_Empleado"] . ");'><i class='fa fa-check'></i></a>" . "</td>";
            }

            echo "</tr>";
        }
    }
}

if(isset($_GET["VerificarExisteCorreo"])){

    $resultadp = VerificarExisteCorreoModel($_GET['correoElectronico']);

    if($resultadp -> num_rows > 0)
    {
        echo "El correo ya existe" ;
    }
    else
    {
        echo "OK";
    }
}

if(isset($_POST["btnRecuperarCuenta"]))
{
    $correoElectronico = $_POST["correoElectronico"];

    $resultado = VerificarExisteCorreoModel($correoElectronico);

    if($resultado -> num_rows > 0)
    {
        $datosResultado = mysqli_fetch_array($resultado); 
        EnviarCorreo($correoElectronico,"Recuperación de contraseña","Su contraseña es: " . $datosResultado["contrasena"],null,null);
    }
    else
    {
        echo "No se pudo recuperar su contraseña";
    }
}

function VerDatosEmpleado($idEmpleado)
{
    $resultado = VerDatosEmpleadoModel($idEmpleado);
    if ($resultado->num_rows > 0) {
        return mysqli_fetch_array($resultado);
    }
}
if (isset($_POST["EliminarEmpleado"])) {

    $resultadp = EliminarEmpleadoModel($_POST['consecutivoEmpleado']);

    if ($resultadp) {
        echo "OK";
    }
}

if (isset($_POST["ActivarEmpleado"])) {

    $resultadp = ActivarEmpleadoModel($_POST['consecutivoEmpleado']);

    if ($resultadp) {
        echo "OK";
    }
}




