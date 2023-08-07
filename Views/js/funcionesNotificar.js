function HabilitarBoton() {
  let correoElectronico = $("#correoElectronico").val();
  let archivoAdjunto = $("#archivoAdjunto").val();

  $.ajax({
    url: "../Controllers/usuariosController.php",
    type: "GET",
    data: {
      VerificarExisteCorreo: "VerificarExisteCorreo",
      correoElectronico: correoElectronico,
    },
    success: function (res) {
      if (res != "OK") {
        if (archivoAdjunto.trim() != "" && correoElectronico.trim() != "") {
          $("#btnNotificar").prop("disabled", false);
        }
      } else {
        alert("El correo electrónico que ingresó no se encuentra registrado");
      }
    },
  });
}
