<?php

require_once '../models/ventas.php';

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
}