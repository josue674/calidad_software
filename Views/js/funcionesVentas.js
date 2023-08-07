function actualizarEnlace() {
  var valor = document.getElementById("nombreProducto");
  document
    .getElementById("enlace")
    .setAttribute("href", "../Views/ventas.php?nombreProducto=" + valor.value);
}

function AgregarProducto(idProducto,CantidadDisponible) {
  var cantidad = document.getElementById("cantidad" + idProducto).value;
  $.ajax({
    url: "../Controllers/ventasController.php",
    type: "POST",
    data: {
      AgregarProducto: "AgregarProducto",
      idProducto: idProducto,
      cantidad: cantidad,
      CantidadDisponible: CantidadDisponible,
    },
    success: function (res) {
      if (res == "ok") {
        location.reload();
      } else {
        Swal.fire({
          icon: "error",
          title: res,
          showConfirmButton: false,
        });
      }
    },
  });
}

function EliminarProducto(idProducto,Cantidad) {
  $.ajax({
    url: "../Controllers/ventasController.php",
    type: "POST",
    data: {
      EliminarProducto: "EliminarProducto",
      idProducto: idProducto,
      Cantidad: Cantidad,
    },
    success: function (res) {
      console.log(res);
      if (res == "ok") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Eliminado",
          showConfirmButton: false,
          timer: 1500,
        });
        setTimeout(function () {
          location.reload();
        }, 500);
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

function EnviarFactura(Carrito) {
  // console.log(Carrito);
  Swal.fire({
    title: "Enviando Factura",
    html: "Cargando <b></b> ",
    timer: 20000,
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    }
  })
  $.ajax({
    url: "../Controllers/EmailController.php",
    type: "POST",
    data: {
      EnviarFactura: "EnviarFactura",
      Carrito: Carrito,
    },
    success: function (res) {
      if (res == "OK") {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Enviado",
          showConfirmButton: false,
          timer: 1500,
        });
        setTimeout(function () {
          window.location.replace("http://localhost:85/Views/ventas.php?nombreProducto=");
        }, 500);
      } else {
        console.log(res);
        Swal.fire({
          icon: "error",
          title: "Oops...",
          showConfirmButton: false,
        });
      }
    },
  });
}
