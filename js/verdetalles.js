$(document).ready(function (){
    
    let idcliente = 0;
    const cuerpoTabla2 = document.querySelector("#detallescuerpo");
    
    function mostrardetalles(id){
        console.log("mostrar - id recibido:", idcliente);
        
        $.ajax({
            url: '../controllers/reportes.pago.controller.php',
            type: 'POST',
            data: {
                'operacion' : 'filtropagodetalle',
                'idcliente'   : id,
            },
            dataType: 'json',
            success: function (data){
                data.forEach(element => {
                    const row = `
                        <tr>
                            <td class='text-center d-none'>${element.idcliente}</td>
                            <td class='text-center'>${element.Cliente}</td>
                            <td class='text-center'>${element.fechapago}</td>
                            <td class='text-center d-none'>${element.nombre}</td>
                            <td class='text-center'>${element.banco}</td>>
                            <td class='text-center'>${element.numoperacion}</td>
                            <td class='text-center'>${element.pago}</td>                                               
                        </tr>
                    `;
                    cuerpoTabla2.innerHTML += row; 
                    
                });

                // Destruir la instancia actual de DataTables
                if ($.fn.DataTable.isDataTable('#table-detalles')) {
                    $('#table-detalles').DataTable().destroy()
                }

                $(document).ready(function(){                                   
                    $('#table-detalles').DataTable({
                        responsive: true ,
                        lengthMenu:[5],
                        language: {
                            url: '../js/Spanish.json'
                        },   
                    });
                })
            }
        });

        


    }


    $("#table-report tbody").on("click", ".mostrar", function (){
        idcliente = $(this).data("idcliente");        
        mostrardetalles(idcliente);
    
    });

})