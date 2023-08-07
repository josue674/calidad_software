function HabilitarBoton() {
    /*
        let correo = document.getElementById("correoElectronico").value;
        let clave = document.getElementById("contrasenna").value;
        
        if (correo.trim() != "" && clave.trim() != "") {
            document.getElementById("btnIniciarSesion").disabled = false;
        }
        else {
            document.getElementById("btnIniciarSesion").disabled = true;
        }
    */

    let correo = $("#correoElectronico").val();
    let clave = $("#contrasenna").val();

    if (correo.trim() != "" && clave.trim() != "") {
        $("#btnIniciarSesion").prop("disabled", false);
    }
    else {
        $("#btnIniciarSesion").prop("disabled", true);
    }

}