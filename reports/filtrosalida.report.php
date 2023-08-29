<?php
require_once '../vendor/autoload.php';
require_once '../models/reportes.php';


use Spipu\Html2Pdf\Html2Pdf; 
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {

    $reporte = new Reporte();

    $idinsumo = isset($_GET['idinsumo']) && is_numeric($_GET['idinsumo']) ? intval($_GET['idinsumo']) : null;
    $fechainicio    = $_GET['fechainicio'] ?? null;
    $fechafin       = $_GET['fechafin'] ?? null;


    if(!empty($idinsumo)){
        $data = $reporte->filtrosalidaidinsu($idinsumo);

    }elseif (!empty($fechainicio) && !empty($fechafin)){
        $data = $reporte->filtrosalidafecha($fechainicio, $fechafin);

    }elseif(!empty($fechainicio) && !empty($fechafin) && !empty($idinsumo)){
        $data = $reporte->filtrosalidaidfech($fechainicio, $fechafin , $idinsumo);
    }

    $fechaI = $_GET['fechaI'];
    $fechaF = $_GET['fechaF'];

    ob_start();

    //Archivos que componen el PDF
    include './estilos.report.html';
    include './filtrosalida.data.php';

    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'A4', 'es');
    $html2pdf->writeHTML($content);
    $html2pdf->output('Reporte-pagos.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}