<?php
require_once '../vendor/autoload.php';
require_once '../models/ventas.php';

use Spipu\Html2Pdf\Html2Pdf; 
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    $venta = new Ventas();

    $idventa = isset($_GET['idventa']) && is_numeric($_GET['idventa']) ? intval($_GET['idventa']) : null;
    $datos = $venta->obtener_detalleV($idventa);

    if ($datos) { 
        $ventaData = $datos; 

              $clientes = $ventaData['clientes'];
               $nombre = $ventaData['nombre'];
               $cantidad = $ventaData['cantidad'];
               $paquetes = $ventaData['paquetes'];
               $kilos = $ventaData['kilos'];
               $precio = $ventaData['precio'];
               $flete = $ventaData['flete'];
               $monto = $ventaData['monto'];
               $totalPago = $ventaData['totalPago'];
               $fechaventa = $ventaData['fechaventa'];

        ob_start();

        //Archivos que componen el PDF
        include './estilos.ventaR.html';
        include './venta.data.php';

        $content = ob_get_clean();

        $html2pdf = new Html2Pdf('P', 'A4', 'es');
        $html2pdf->writeHTML($content);
        $html2pdf->output('Comprobante-venta.pdf');
    } else {
        echo "No se encontraron datos para la venta con ID: " . $idventa;
    }
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
