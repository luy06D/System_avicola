<?php

require_once '../models/ventas.php';

function renderJSON($object = []){
    if($object){
        echo json_encode($object);
    }
}

if (isset($_POST['operacion'])){

    $ventas = new Ventas();

    if($_POST['operacion'] == 'registrar'){
        $datosGuardar = [
            "iddetalle_venta"      => $_POST['iddetalle_venta'],   
            "idusuario"      => $_POST['idusuario'],
            "idcliente"      => $_POST['idcliente']
        ];
        $respuesta = $ventas->RegistrarVentas($datosGuardar);
        echo json_encode($respuesta);
    }
    if($_POST['operacion'] == 'resumeVentas'){
        $datos = $ventas->getVentasResume();
        renderJSON($datos);
    }
}