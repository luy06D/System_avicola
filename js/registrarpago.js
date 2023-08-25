$(document).ready(function (){

 

    let idventa = 0;

 

    function registrar(id) {
        Swal.fire({
            title: '¿Está seguro de realizar la operación?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#65BB3B',
        }).then((result) => {
            if (result.isConfirmed) {
                const banco = $("#banco").val().trim();
                const numoperacion = $("#numoperacion").val().trim();
                const pago = $("#pago").val().trim();

 

                if (banco === '' || numoperacion === '' || pago === '' || parseFloat(pago) === 0) {
                    Swal.fire({
                        title: "Por favor, complete los campos y asegúrese de que el pago no sea cero.",
                        icon: "warning",
                        confirmButtonColor: "#E43D2C",
                    });
                } else {
                    let datosEnviar = {
                        'operacion': 'registrar',
                        'idventa': id,
                        'banco': banco,
                        'numoperacion': numoperacion,
                        'pago': pago
                    };

 

                    $.ajax({
                        url: '../controllers/pagos.controller.php',
                        type: 'GET',
                        data: datosEnviar,
                        success: function (result) {
                            $("#form-pagos")[0].reset();
                            mostrar();
                            $("#modal-registrar").modal('hide');
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Operación exitosa',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                }
            }
        });
    }

 

    $("#tabla-pago tbody").on("click", ".abonar", function () {
        idventa = $(this).data("idventa");
    });

    
});














































































