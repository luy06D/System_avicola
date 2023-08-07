<?php

require_once '../models/reportes.php';

if(isset($_POST['operacion'])){

    $reporte = new Reporte();

    if($_POST['operacion'] == 'filtraVentas'){
        $data = $reporte->filtroVentas($_POST['fechainicio'], $_POST['fechafin']);
        echo json_encode($data);
    }
}

?>