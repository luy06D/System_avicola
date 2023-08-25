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
                            <td class='text-center'>${element.fechapago}</td>
                            <td class='text-center'>${element.nombre}</td>
                            <td class='text-center'>${element.banco}</td>>
                            <td class='text-center'>${element.numoperacion}</td>
                            <td class='text-center'>${element.pago}</td>                                               
                        </tr>
                    `;
                    cuerpoTabla2.innerHTML += row; 
                    
                });
            }
        });

    }


    $("#table-report tbody").on("click", ".mostrar", function (){
        idcliente = $(this).data("idcliente");        
        mostrardetalles(idcliente);
    
    });

})