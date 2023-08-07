function EliminarEmpleado(consecutivoEmpleado) {
  // let confirmAction = confirm("Are you sure to execute this action?");
  Swal.fire({
    title: "Esta seguro de eliminar este empleado?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "No",
    confirmButtonText: "Si",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../Controllers/empleadosController.php",
        type: "POST",
        data: {
          EliminarEmpleado: "EliminarEmpleado",
          consecutivoEmpleado: consecutivoEmpleado,
        },
        success: function (res) {
          if (res == "OK") {
            Swal.fire({
              title: "Eliminado!",
              confirmButtonText: "Volver",
              allowOutsideClick: false,
            })
            .then((result) => {
              if (result.isConfirmed) {
                location.reload();
              }
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              showConfirmButton: false,
            });
          }
        },
      });
    }
  });
}

function ActivarEmpleado(consecutivoEmpleado) {
  $.ajax({
    url: "../Controllers/empleadosController.php",
    type: "POST",
    data: {
      ActivarEmpleado: "ActivarEmpleado",
      consecutivoEmpleado: consecutivoEmpleado,
    },
    success: function (res) {
      if (res == "OK") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Activado",
          showConfirmButton: false,
          timer: 1500,
        });
        setTimeout(function () {
          location.reload();
        }, 1500);
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops...",
          showConfirmButton: false,
        });
      }
    },
  });
}

function HabilitarBotonRecuperacion() {

  let correoElectronico = $("#correoElectronico").val().trim();
  $("#btnRecuperarCuenta").prop("disabled", true);
  $.ajax({
      url:  '../Controllers/empleadosController.php',
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
