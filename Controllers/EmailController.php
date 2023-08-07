<?php
include_once '../PHPMailer/src/PHPMailer.php';
include_once '../PHPMailer/src/SMTP.php';
include_once '../fpdf185/fpdf.php';
include_once '../Models/ventasModel.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["EnviarFactura"])) {
    $email =  $_SESSION["CorreoCliente"];
    $nombre = $_SESSION["Nombre"];
    $Identificacion = $_SESSION["Identificacion"];
    $Telfono = $_SESSION["Telfono"];
    $idEmpleado = $_SESSION["idEmpleado"];
    $idFactura = $_SESSION["Factura"];
    $Carrito = json_decode(json_encode($_POST["Carrito"]));

    // Crear objeto FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Agregar encabezado
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Factura de compra', 0, 1, 'C');
    $pdf->Ln();

    // Agregar detalles de la factura
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, 'Nombre:', 0);
    $pdf->Cell(0, 10, $nombre, 0, 1);
    $pdf->Cell(60, 10, 'Email:', 0);
    $pdf->Cell(0, 10, $email, 0, 1);
    $pdf->Cell(60, 10, 'Identificacion:', 0);
    $pdf->Cell(0, 10, $Identificacion, 0, 1);
    $pdf->Cell(60, 10, 'Telfono:', 0);
    $pdf->Cell(0, 10, $Telfono, 0, 1);
    $pdf->Cell(60, 10, 'ID del empleado:', 0);
    $pdf->Cell(0, 10, $idEmpleado, 0, 1);
    $pdf->Cell(60, 10, 'Consecutivo de la factura:', 0);
    $pdf->Cell(0, 10, $idFactura, 0, 1);
    $pdf->Ln();

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(90, 10, 'Nombre', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Precio', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Subtotal', 1, 1, 'C');

    $total = 0;
    foreach ($Carrito as $key => $value) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(90, 10, $value->nombre_Producto, 1);
        $pdf->Cell(30, 10, $value->cantidad_Venta, 1, 0, 'R');
        $pdf->Cell(30, 10, '$' . $value->precio_Venta, 1, 0, 'R');
        $pdf->Cell(30, 10, '$' . $value->cantidad_Venta * $value->precio_Venta, 1, 1, 'R');
        $total += $value->cantidad_Venta * $value->precio_Venta;
    }

    // Agregar total
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Total: $' . $total, 0, 1, 'R');

    // Guardar archivo PDF
    $pdf->Output('factura.pdf', 'F');

    // Enviar correo electrónico con archivo adjunto
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.office365.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'josueaguirre03@outlook.com';
    $mail->Password = 'aL&S&Fi75g35h@Gm';
    $mail->setFrom('josueaguirre03@outlook.com', 'Tu nombre');
    $mail->addAddress($email);
    $mail->addAttachment('factura.pdf');
    $mail->Subject = 'Factura de compra';
    $mail->Body = 'Adjunto se encuentra la factura de compra.';
    try {
        if ($mail->send()) {
            
            $_SESSION["Identificacion"] = '';
            $_SESSION["CorreoCliente"] = '';
            $_SESSION["Nombre"] = '';
            $_SESSION["Telfono"] = '';
            $_SESSION["idCliente"] = '';
            $_SESSION["Factura"] = '';
            EliminarCarritoTotalModel($idFactura);
            echo 'OK';
        } else {
            echo 'Error';
        }
    } catch (\Throwable $th) {
        echo $th;
    }
}

function EnviarCorreo($destinatario, $asunto, $cuerpo, $adjunto, $nombreAdjunto)
{

    $mail = new PHPMailer();
    $mail->CharSet = "UTF-8";

    $mail->IsSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'josueaguirre03@outlook.com';
    $mail->Password = 'aL&S&Fi75g35h@Gm';

    $mail->SetFrom('josueaguirre03@outlook.com', "Sistema de Gestión de Proyectos");
    $mail->Subject = $asunto;
    $mail->MsgHTML($cuerpo);
    if ($adjunto != null) {
        $mail->addAttachment($adjunto, $nombreAdjunto, 'base64', 'application/pdf');
    }
    $mail->AddAddress($destinatario, 'Usuario Sistema');

    if ($mail->send()) {
        
    } else {
         echo "Error al enviar correo";
    }
}
