
function crearCajas() {
    var cantidad = parseInt(document.getElementById("cantidad").value);

    if (isNaN(cantidad) || cantidad < 1 || cantidad > 500) {
        alert("Ingrese un número válido entre 1 y 500.");
        return;
    }

    var contenedorCajas = document.getElementById("contenedorCajas");
    contenedorCajas.innerHTML = ""; // Limpiamos el contenido previo

    for (var i = 0; i < cantidad; i++) {
        var nuevaCaja = document.createElement("input");
        nuevaCaja.type = "number";
        nuevaCaja.id = "caja";
        nuevaCaja.className = "col-2";
        nuevaCaja.placeholder = "Paquete " + (i + 1);
        nuevaCaja.addEventListener("input", actualizarTotal);
        contenedorCajas.appendChild(nuevaCaja);
    }

    actualizarTotal();
}

function limpiarCajas() {
  const cajasContainer = document.getElementById("contenedorCajas");
  cajasContainer.innerHTML = ""; // Elimina el contenido del contenedor
  
  const input1 = document.getElementById("cliente");
  const input2 = document.getElementById("fecha");
  const input3 = document.getElementById("cantidad");
  const input4 = document.getElementById("totalValores");
  const input5 = document.getElementById("factor");
  const input6 = document.getElementById("resultadoMultiplicacion");
  const input7 = document.getElementById("flete");
  const input8 = document.getElementById("resultadoResta");
  const input9 = document.getElementById("nombres");
  const input10 = document.getElementById("apellidos");
  const input11 = document.getElementById("dni");
  const input12 = document.getElementById("telefono");

  if (input1) input1.value = ""; // Verificar si existe y limpiar el input
  if (input2) input2.value = "";
  if (input3) input3.value = "";
  if (input4) input4.value = ""; 
  if (input5) input5.value = "";
  if (input6) input6.value = "";
  if (input7) input7.value = ""; 
  if (input8) input8.value = "";
  if (input9) input9.value = "";
  if (input10) input10.value = "";
  if (input11) input11.value = "";
  if (input12) input12.value = "";

}


function actualizarTotal() {
    var cajas = document.getElementById("contenedorCajas").getElementsByTagName("input");
    var sumaValoresCajas = 0;

    for (var i = 0; i < cajas.length; i++) {
        sumaValoresCajas += parseFloat(cajas[i].value) || 0; // Si el valor no es un número, se sumará 0.
    }

    var factor = parseFloat(document.getElementById("factor").value) || 0;
    var flete = parseFloat(document.getElementById("flete").value) || 0;

    var totalMultiplicacion = sumaValoresCajas * factor;
    var totalConFlete = totalMultiplicacion - (flete * sumaValoresCajas);
    totalConFlete = totalConFlete.toFixed(2);

    document.getElementById("totalValores").value = sumaValoresCajas.toFixed(2);
    document.getElementById("resultadoMultiplicacion").value = totalMultiplicacion.toFixed(2);
    document.getElementById("resultadoResta").value = totalConFlete;
}
