$(document).ready(function (){

    let idventa = 0;


    function mostrar_detalleV(){  
        console.log("idventa: " + idventa);
        window.open(`../reports/detalleVenta.report.php?idventa=${idventa}`,`_blank`);
    }

    $("#table-report tbody").on("click", ".mostrar", function (){
        idventa = $(this).data("idventa");        
        mostrar_detalleV();
        

    });


    

})