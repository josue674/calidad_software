function EliminarCleinte(consecutivoCliente) {
  // let confirmAction = confirm("Are you sure to execute this action?");
  Swal.fire({
    title: "Esta seguro de eliminar este Clinte?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "No",
    confirmButtonText: "Si",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../Controllers/clientesController.php",
        type: "POST",
        data: {
          ElimiarCliente: "ElimiarCliente",
          consecutivoCliente: consecutivoCliente,
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

function ActivarCliente(consecutivoCliente) {
  $.ajax({
    url: "../Controllers/clientesController.php",
    type: "POST",
    data: {
      ActivarCliente: "ActivarCliente",
      consecutivoCliente: consecutivoCliente,
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
