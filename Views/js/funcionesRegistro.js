function HabilitarBoton() {

    let correoElectronico = $("#correoElectronico").val().trim();
    let contrasenna = $("#contrasenna").val().trim();
    let confirmarContrasenna = $("#confirmarContrasenna").val().trim();
    $("#btnRegistrarCuenta").prop("disabled", true);

    
    $.ajax({
        url:  '../Controllers/usuariosController.php',
        type: 'GET',
        data: { 
            "VerificarExisteCorreo" : "VerificarExisteCorreo",
            "correoElectronico" : correoElectronico 
        },
        success: function(res) 
        {
            if(res == "OK")
            {
                if (correoElectronico !== "" && contrasenna !== "" && confirmarContrasenna !== "") 
                {
                    if(contrasenna === confirmarContrasenna)
                    {
                        $("#btnRegistrarCuenta").prop("disabled", false);
                    }
                }
            }
            else
            {
                alert(res);
            }
        }
     });
}