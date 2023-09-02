$(document).ready(function () {
    let iddetalle_insumo = 0;




    function update_detalleI(){
        const cantidad = document.querySelector("#cantidadUp").value.trim();
        const idinsumo = document.querySelector("#insumoUp").value.trim();


        let datosEnviar = {
            'operacion' : 'detalle_update',
            'iddetalle_insumo': iddetalle_insumo,
            'idinsumo': $("#insumoUp").val(),
            'cantidad': $("#cantidadUp").val(),
        };

        Swal.fire({
            title: '¿Está seguro de realizar la operación?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#3F974F',
            cancelButtonColor: '#3085d6',

        }).then((result) => {
            if (result.isConfirmed) {
                if(cantidad === '' || idinsumo === ''){
                    Swal.fire({
                        title: "Por favor, complete los campos",
                        icon: "warning",
                        confirmButtonColor: "#E43D2C",
                    });

                }else{
                    Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Operación exitosa',
                showConfirmButton: false,
                timer: 1500
                })

                $.ajax({
                    url: '../controllers/formulas.controller.php',
                    type: 'POST',
                    data: datosEnviar,
                    success: function (result) { 
                        $("#modal-updateInsumo").modal('hide');
                        
                        
                    }
                });

                }
        
            }
        });


    }

    function formula_eliminar(){

        const idformula = document.querySelector("#lista-formula").value;
        Swal.fire({
            title: '¿Está seguro de eliminar el registro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../controllers/formulas.controller.php',
                    type: 'POST',
                    data: {
                        'operacion': 'formula_eliminar',
                        'idformula': idformula
                    },
                    success: function () {
      
                    }
                });
            }
        });

    }
    
    
    function mostrarDatos() {
        $.ajax({
            url: '../controllers/formulas.controller.php',
            type: 'GET',
            data: {
                'operacion': 'obtener_detalleI',
                'iddetalle_insumo': iddetalle_insumo
            },
            dataType: 'JSON',
            success: function (result) {
                console.log(result);
    
                
                if (Array.isArray(result) && result.length > 0) {
                    var detalleInsumo = result[0]; 
    
                    $("#insumoUp").val(detalleInsumo.idinsumo);
                    $("#cantidadUp").val(detalleInsumo.cantidad); 
                }
            }
        });
    }

    $('#descontar').click(function() {
        // Mostrar una ventana de confirmación SweetAlert2
        Swal.fire({
            title: '¿Desea utilizar la fórmula?',
            text: 'Está a punto de aplicar la fórmula a los insumos.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, Utilizar',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#3F974F',
            cancelButtonColor: '#3085d6',
        }).then((result) => {
            if (result.isConfirmed) {
                // El usuario confirmó, procede a enviar los datos al servidor
    
                // Crear un array para almacenar los datos de la tabla
                var datosTabla = [];
    
                var idformula = $('#lista-formula').val();
    
                // Variable para verificar si se puede registrar
                var sePuedeRegistrar = true;
    
                // Iterar a través de las filas de la tabla (excluyendo la primera fila de encabezado)
                $('#tabla-formula tbody tr').each(function() {
                    var fila = $(this);
                    var idinsumo = fila.find('td:eq(1)').text();
                    var cantidadtn = parseFloat(fila.find('td:eq(4)').text());
                    var cantidadsacos = parseFloat(fila.find('td:eq(5)').text());
    
                    // Verificar si la cantidad es suficiente
                    if (isNaN(cantidadtn) || isNaN(cantidadsacos) || cantidadtn < 0 || cantidadsacos < 0) {
                        sePuedeRegistrar = false;
                        // Mostrar una alerta de cantidad insuficiente
                        Swal.fire({
                            icon: 'error',
                            title: 'Cantidad Incorrecta',
                            text: 'Por favor, ingrese cantidades válidas para todos los insumos.'
                        });
                        // Detener el bucle
                        return false;
                    }
    
                    // Agregar los datos de la fila al array
                    datosTabla.push({
                        idformula: idformula,
                        idinsumo: idinsumo,
                        cantidadtn: cantidadtn,
                        cantidadsacos: cantidadsacos,
                    });
                });
    
                // Verificar si se puede registrar
                if (sePuedeRegistrar) {
                    // Construir el objeto a enviar con la operación y los datos
                    var datosAEnviar = {
                        operacion: 'descontar_insumos', // Especifica la operación en el controlador
                        datos: datosTabla, // Los datos de la tabla
                    };
    
                    // Enviar los datos al servidor utilizando AJAX
                    $.ajax({
                        url: '../controllers/formulas.controller.php',
                        method: 'POST',
                        dataType: 'json',
                        data: { operacion: datosAEnviar.operacion, datos: JSON.stringify(datosAEnviar.datos) }, // Envía la operación y los datos
                        success: function(response) {
                            console.log(response); // Manejar la respuesta del servidor si es necesario
    
                            if (response.status) {
                                // Mostrar una alerta SweetAlert2 de éxito
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Registro exitoso',
                                    text: 'Los datos se han registrado correctamente.'
                                });
                            } else {
                                // Mostrar una alerta SweetAlert2 de error
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Error',
                                    confirmButtonColor: "#E43D2C",
                                    text: response.message
                                });
                            }
                        },
                        error: function(error) {
                            console.error('Error:', error);
                            // Mostrar una alerta SweetAlert2 de error si el registro falla
                            Swal.fire({
                                icon: 'warning',
                                title: 'Error',
                                confirmButtonColor: "#E43D2C",
                                text: 'No hay insumos suficientes.'
                            });
                        }
                    });
                }
            } else {
                // El usuario canceló, no hagas nada
            }
        });
    });
    
    

    

      


    

    $("#tabla-formula tbody").on("click", ".detalle_insumo", function () {
        iddetalle_insumo = $(this).data("iddetalle_insumo");
        mostrarDatos();
        
    });

    $("#btnUpdateInsumo").click(update_detalleI);
    $("#btnDelete").click(formula_eliminar);

});
