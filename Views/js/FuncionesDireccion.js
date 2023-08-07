function cargarDatos() {
  var provincia = document.getElementById("provincia");
  var canton = document.getElementById("canton");  
  var distrito = document.getElementById("distrito");
  var opcionSeleccionada = provincia.value;
  $.ajax({
    url: "../../Controllers/DireccionController.php",
    type: "GET",
    data: { opcionSeleccionada: opcionSeleccionada },
    dataType: "json",
    success: function (datos) {
      // Se eliminan las opciones actuales del segundo select
      while (canton.options.length > 0) { 
        canton.remove(0);
      }
      while (distrito.options.length > 0) {
        distrito.remove(0);
      }
      console.log(datos);
      // Se agregan las nuevas opciones al segundo select
      for (var i = 0; i < datos.length; i++) {
        var option = document.createElement("option");
        option.value = datos[i].id;
        option.text = datos[i].nombre;
        canton.appendChild(option);
      }
    },
  });
}
function cargarDatos2() {
    var canton = document.getElementById("canton");
    var distrito = document.getElementById("distrito");
    var opcionSeleccionada2 = canton.value;
    $.ajax({
      url: "../../Controllers/DireccionController.php",
      type: "GET",
      data: { opcionSeleccionada2: opcionSeleccionada2 },
      dataType: "json",
      success: function (datos) {
        // Se eliminan las opciones actuales del segundo select
        while (distrito.options.length > 0) {
          distrito.remove(0);
        }
        // Se agregan las nuevas opciones al segundo select
        for (var i = 0; i < datos.length; i++) {
          var option = document.createElement("option");
          option.value = datos[i].id;
          option.text = datos[i].nombre;
          distrito.appendChild(option);
        }
      },
    });
  }
