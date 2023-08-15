$(document).ready(function (){

    let idventa = 0;

  

    function mostrarJson(id){
        console.log("mostrarJson - id recibido:", id);
        $.ajax({
            url: '../controllers/reportes.controller.php',
            type: 'POST',
            data: {
                'operacion' : 'mostrarJson',
                'idventa'   : id
            },
            dataType: 'JSON',
            success: function (result){
                let paquetesObj = JSON.parse(result[0].paquetes);
                let contenidoHTML = '<div class="paquetes"><ul>';
                for (const key in paquetesObj) {
                    contenidoHTML += '<li>' + key + ':'+ ' ' + paquetesObj[key] +  '</li>';
                }
                contenidoHTML += '</ul></div>';
                $("#conten_paquetes").html(contenidoHTML);
            
            }

        });

    }

    $("#table-report tbody").on("click", ".mostrar", function (){
        idventa = $(this).data("idventa");        
        mostrarJson(idventa);
        

    });

})