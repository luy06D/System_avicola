<?php

require_once '../models/ventas.php';

function renderJSON($object = []){
    if($object){
        echo json_encode($object);
    }
}


if (isset($_POST['operacion'])){

    $ventas = new Ventas();

    if($_POST['operacion'] == 'ventasRegistrar'){

        $datosGuardar = [
            "idproducto"      => $_POST['idproducto'],   
            "cantidad"        => $_POST['cantidad'],
            "idusuario"       => $_POST['idusuario'],
            "idcliente"       => $_POST['idcliente'],
            "kilos"           => $_POST['kilos'],
            "precio"          => $_POST['precio'],
            "flete"           => $_POST['flete'],
            "deuda"           => $_POST['deuda'],
            "paquetes"        => $_POST['paquetes']

        ];

        $respuesta = $ventas->ventas_registrar($datosGuardar);
        echo json_encode($respuesta);
    }

    if($_POST['operacion'] == 'recuperarProduct'){
        echo json_encode($ventas->recuperarProductos());
    }

    if($_POST['operacion'] == 'recuperarClient'){
        echo json_encode($ventas->recuperarClientes());
    }



    if($_POST['operacion'] == 'resumeVentas'){
        $datos = $ventas->getVentasResume();
        renderJSON($datos);
    }
    if($_POST['operacion'] == 'grafico2'){
        $datos = $ventas->Grafico2();
        renderJSON($datos);
    }

    if($_POST['operacion'] == 'ultimaVenta'){
        $datos = $ventas->obtener_ultimaV();
        renderJSON($datos);
    }

}