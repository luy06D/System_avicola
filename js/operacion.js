
var valoresJson = {};

function crearCajas() {
    var cantidad = parseInt(document.getElementById("cantidad").value);

    if (isNaN(cantidad) || cantidad < 1 || cantidad > 500) {
        Swal.fire({
            icon: 'error',
            title: 'Ingrese un número válido entre 1 y 500',
            showConfirmButton: false,
            timer: 2000
        })
        return;
    }

    var contenedorCajas = document.getElementById("contenedorCajas");
     // Limpiamos el contenido previo


    for (var i = 0; i < cantidad; i++) {
        var nuevaCaja = document.createElement("input");
        nuevaCaja.type = "number";
        nuevaCaja.id = "caja" + (i + 1); // Añadir un identificador único para cada input
        nuevaCaja.className = "cajastyle";
        nuevaCaja.addEventListener("input", function() {
            validarNumero(this);
            actualizarTotal();

            valoresJson[this.id] = this.value;
            console.log(valoresJson);
            
        });
        contenedorCajas.appendChild(nuevaCaja);

    }

    actualizarTotal();

    return valoresJson;
}




function validarNumero(input) {
    var valor = parseFloat(input.value);
    
    if (isNaN(valor) || valor < 1 || valor > 10) {
        Swal.fire({
            icon: 'error',  
            title: 'Por favor!, ingrese número valido entre 1 a 10',
            showConfirmButton: false,
            timer: 1000
        })
        input.value = ""; // Borra el contenido del input
    }
}

function limpiarCajas() {
  const cajasContainer = document.getElementById("contenedorCajas");
  cajasContainer.innerHTML = ""; // Elimina el contenido del contenedor
  
  const input1 = document.getElementById("cliente");
  const input2 = document.querySelector("#producto");
  const input3 = document.getElementById("cantidad");
  const input4 = document.getElementById("totalValores");
  const input5 = document.getElementById("factor");
  const input6 = document.getElementById("resultadoMultiplicacion");
  const input7 = document.getElementById("flete");
  const input8 = document.getElementById("resultadoResta");
  $("#cliente").val(null).trigger('change');

  if (input1) input1.value = ""; // Verificar si existe y limpiar el input
  if (input2) input2.value = "";
  if (input3) input3.value = "";
  if (input4) input4.value = ""; 
  if (input5) input5.value = "";
  if (input6) input6.value = "";
  if (input7) input7.value = ""; 
  if (input8) input8.value = "";

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
