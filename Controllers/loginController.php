<?php
include_once '../Models/loginModel.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["btnIniciarSesion"])) {
    $correoElectronico = $_POST["correoElectronico"];
    $contrasenna = $_POST["contrasenna"];

    $resultado = ValidarInicioSesionModel($correoElectronico, $contrasenna);

    if ($resultado->num_rows > 0) {
        $datosResultado = mysqli_fetch_array($resultado);
        $_SESSION["idEmpleado"] = $datosResultado["id_Empleado"];
        $_SESSION["Correo"] = $datosResultado["correo"];
        $_SESSION["Identificacion"] = $datosResultado["num_identificacion"];
        $_SESSION["TipoUsuario"] = $datosResultado["id_usuario_Rol"];
        $_SESSION["NombreRol"] = $datosResultado["nombre_Rol"];

        if ($datosResultado["nombre_Rol"] == 'Bodeguero') {
            header("location: ../Views/productoInformacion.php");
        } else {
            header("location: ../Views/ventas.php?nombreProducto=");
        }
    } else {
        header("location: ../Views/login.php");
    }

    $_SESSION["Identificacion"] = "";
    $_SESSION["CorreoCliente"] = "";
    $_SESSION["Nombre"] = "";
    $_SESSION["Telfono"] = "";
    $_SESSION["idCliente"] = "";
    $_SESSION["Factura"] = "";
    $_SESSION["Carrito"] = [];
}
