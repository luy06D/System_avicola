<?php

require_once '../vendor/autoload.php';
require_once '../models/reportes.php';


use Spipu\Html2Pdf\Html2Pdf; 
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {

    $reporte = new Reporte();
    $data = $reporte->filtroVentas($_GET['fechainicio'], $_GET['fechafin']);
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