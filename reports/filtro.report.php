<?php

require_once '../vendor/autoload.php';
require_once '../models/reportes.php';


use Spipu\Html2Pdf\Html2Pdf; 
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {

    $reporte = new Reporte();

    $idcliente = isset($_GET['idcliente']) && is_numeric($_GET['idcliente']) ? intval($_GET['idcliente']) : null;
    $fechainicio    = $_GET['fechainicio'] ?? null;
    $fechafin       = $_GET['fechafin'] ?? null;


    if(!empty($fechainicio) && !empty($fechafin) && !empty($idcliente)){
        $data = $reporte->filtro3Ventas($fechainicio, $fechafin , $idcliente);

    }elseif (!empty($fechainicio) && !empty($fechafin)){
        $data = $reporte->filtro2Ventas($fechainicio, $fechafin);

    }elseif(!empty($idcliente)){
        $data = $reporte->filtro1Ventas($idcliente);
    }

    $fechaI = $_GET['fechaI'];
    $fechaF = $_GET['fechaF'];

    ob_start();

    //Archivos que componen el PDF
    include './estilos.report.html';
    include './filtro.data.php';

    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'A4', 'es');
    $html2pdf->writeHTML($content);
    $html2pdf->output('Reporte-ventas.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}