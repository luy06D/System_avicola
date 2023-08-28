<?php
require_once '../vendor/autoload.php';
require_once '../models/reportes.pago.php';

use Spipu\Html2Pdf\Html2Pdf; 
use Spipu\Html2Pdf\Exception\Html2PdfException;

try {
    $reporte = new ReportePago();

    // Verifica si el parámetro idcliente está presente en $_POST
    if (isset($_POS['idcliente'])) {
        // Obtén el valor del idcliente
        $idcliente = $_POST['idcliente'];

        // Obtén los datos para el idcliente dado
        $data = $reporte->filtropagodetallecliente($idcliente);

        if ($data) { 
            $pagoData = $data; 

            $cliente = $pagoData['Cliente'];
            $fechapago = $pagoData['fechapago'];
            $banco = $pagoData['banco'];
            $numoperacion = $pagoData['numoperacion'];
            $pago = $pagoData['pago'];
            
            ob_start();

            // Archivos que componen el PDF
            include './estilos.report.html';
            include './detallePago.data.php';

            $content = ob_get_clean();

            $html2pdf = new Html2Pdf('P', 'A4', 'es');
            $html2pdf->writeHTML($content);
            $html2pdf->output('Reporte-detallespagos.pdf');
        } else {
            echo "No se encontraron datos para la venta con ID: " . $idcliente;
        }
    } else {
        echo "El parámetro idcliente no está presente en el formulario.";
    }
} catch (Html2PdfException $e) {
    $html2pdf->clean();
}
?>
