function HabilitarBotonRecuperacion() {

    let correoElectronico = $("#correoElectronico").val().trim();
    $("#btnRecuperarCuenta").prop("disabled", true);

    $.ajax({
        url:  '../Controllers/usuariosController.php',
        type: 'GET',
        data: { 
            "VerificarExisteCorreo" : "VerificarExisteCorreo",
            "correoElectronico" : correoElectronico 
        },
        success: function(res) 
        {
            if(res != "OK")
            {
                $("#btnRecuperarCuenta").prop("disabled", false);
            }
            else
            {
                alert("El correo electrónico que ingresó no se encuentra registrado");
            }
        }
     });
}