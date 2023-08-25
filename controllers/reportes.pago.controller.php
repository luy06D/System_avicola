<?php

require_once '../models/reportes.pago.php';

if(isset($_POST['operacion'])){

    $reportes = new ReportePago();


    if($_POST['operacion'] == 'recuperarCliente'){
        echo json_encode($reportes->recuperarClientes());
    }

    if($_POST['operacion'] == 'filtropagofechas'){
        $data = $reportes->filtropagofecha($_POST['fechainicio'], $_POST['fechafin']);
        echo json_encode($data);
    }

    if($_POST['operacion'] == 'filtropagoclientes'){
        $data = $reportes->filtropagocliente($_POST['idcliente']);
        echo json_encode($data);
    }

    if($_POST['operacion'] == 'filtropagofechacliente'){
        $data = $reportes->filtropagoclientefecha($_POST['fechainicio'], $_POST['fechafin'], $_POST['idcliente']);
        echo json_encode($data);
    }

    if($_POST['operacion'] == 'filtropagodetalle'){
        $data = $reportes->filtropagodetallecliente($_POST['idcliente']);
        echo json_encode($data);
    }
    
}

?>