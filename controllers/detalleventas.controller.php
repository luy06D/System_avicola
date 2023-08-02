<?php

require_once '../models/detalleventa.php';

if (isset($_POST['operacion'])){

    $detalleventas = new DetalleVentas();

    if($_POST['operacion'] == 'registrar'){
        $datosGuardar = [ 
            "idproducto"          => $_POST['idproducto'],
            "cantidad"            => $_POST['cantidad']
        ];
        $respuesta = $detalleventas->RegistrarDetalleVentas($datosGuardar);
        echo json_encode($respuesta);
    }
}