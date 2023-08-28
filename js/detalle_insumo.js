$(document).ready(function () {
    let iddetalle_insumo = 0;




    function update_detalleI(){
        const cantidad = document.querySelector("#cantidadUp").value.trim();
        const unidad = document.querySelector("#unidadUp").value.trim();
        const idinsumo = document.querySelector("#insumoUp").value.trim();


        let datosEnviar = {
            'operacion' : 'detalle_update',
            'iddetalle_insumo': iddetalle_insumo,
            'idinsumo': $("#insumoUp").val(),
            'cantidad': $("#cantidadUp").val(),
            'unidad': $("#unidadUp").val(),
        };

        Swal.fire({
            title: '¿Está seguro de realizar la operación?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#65BB3B',

        }).then((result) => {
            if (result.isConfirmed) {
                if(cantidad === '' || unidad === '' || idinsumo === ''){
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
                    $("#unidadUp").val(detalleInsumo.unidad);
                    $("#cantidadUp").val(detalleInsumo.cantidad); 
                }
            }
        });
    }
    

    $("#tabla-formula tbody").on("click", ".detalle_insumo", function () {
        iddetalle_insumo = $(this).data("iddetalle_insumo");
        mostrarDatos();
        
    });

    $("#btnUpdateInsumo").click(update_detalleI);
    $("#btnDelete").click(formula_eliminar);

});
