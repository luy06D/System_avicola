<?php

require_once '../models/reportes.php';

if(isset($_POST['operacion'])){

    $reporte = new Reporte();

    if($_POST['operacion'] == 'filtra2Ventas'){
        $data = $reporte->filtro2Ventas($_POST['fechainicio'], $_POST['fechafin']);
        echo json_encode($data);
    }

    if($_POST['operacion'] == 'filtra3Ventas'){
        $data = $reporte->filtro3Ventas($_POST['fechainicio'], $_POST['fechafin'], $_POST['idcliente']);
        echo json_encode($data);
    }

    if($_POST['operacion'] == 'filtra1Ventas'){
        $data = $reporte->filtro1Ventas($_POST['idcliente']);
        echo json_encode($data);
    }

    if($_POST['operacion'] == 'recuperarCliente'){
        echo json_encode($reporte->recuperarClientes());
    }

    if($_POST['operacion'] == 'mostrarJson'){
        echo json_encode($reporte->jsonMostrar());
    }
}

?>