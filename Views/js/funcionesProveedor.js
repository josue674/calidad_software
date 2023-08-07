function EliminarProveedor(consecutivoProveedor) {
  // let confirmAction = confirm("Are you sure to execute this action?");
  Swal.fire({
    title: "Esta seguro de eliminar este proveedor?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "No",
    confirmButtonText: "Si",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../Controllers/proveedorController.php",
        type: "POST",
        data: {
          EliminarProveedor: "EliminarProveedor",
          consecutivoProveedor: consecutivoProveedor,
        },
        success: function (res) {
          if (res == "OK") {
            Swal.fire({
              title: "Eliminado!",
              confirmButtonText: "Volver",
              allowOutsideClick: false,
            }).then((result) => {
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

function ActivarProveedor(consecutivoProveedor) {
  $.ajax({
    url: "../Controllers/proveedorController.php",
    type: "POST",
    data: {
      ActivarProveedor: "ActivarProveedor",
      consecutivoProveedor: consecutivoProveedor,
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
