<?php

require_once '../models/pagos.php';

if(isset($_GET['operacion'])){

    $pagos = new Pagos();

    if($_GET['operacion'] == 'listar'){
        $data = $pagos->ListarPagos();
        sleep(0.5);
        if($data){
            foreach($data as $registro){
                echo "
                    <tr>
                    <td>{$registro['idventa']}</td>
                        <td>{$registro['Cliente']}</td>
                        <td>{$registro['fechaventa']}</td>
                        <td>{$registro['deuda_total']}</td>
                        <td>{$registro['pago_total']}</td>
                        <td>{$registro['saldo']}</td>
                        <td>{$registro['estado']}</td>
                        <td>
                            <a href='#'  class='abonar btn btn-outline-success btn-sm' data-bs-toggle='modal' data-bs-target='#modal-registrar' data-idventa='{$registro['idventa']}'><i class='bi bi-pencil-square'></i></a>
                        </td>
                    </tr>
                ";
            }
        }
    } 
        
    

    

    if ($_GET['operacion'] == 'obtener'){
        $data = $cliente->ObtenerCliente($_GET['idventa']);

        echo json_encode($data);
    }
}

if (isset($_POST['operacion'])) {
    $pagos = new Pagos();

    if ($_POST['operacion'] == 'registrar') {
        $datos = [
            "idventa" => $_POST['idventa'],
            "banco" => $_POST['banco'],
            "numoperacion" => $_POST['numoperacion'],
            "pago" => $_POST['pago']
        ];
    
        // Intenta registrar el pago y obtén el resultado
        $resultado = $pagos->RegistrarPagos($datos);
    
        // Establece el encabezado JSON
        header('Content-Type: application/json');
    
        if ($resultado["status"]) {
            // Si la operación se completó con éxito, crea una respuesta JSON con 'status' y 'mensaje'
            $response = array(
                'status' => true,
                'mensaje' => 'Operación exitosa'
            );
        } else {
            // Si la operación falló, crea una respuesta JSON con 'status' y 'mensaje'
            $response = array(
                'status' => false,
                'mensaje' => 'La operación falló'
            );
        }
    
        // Envía la respuesta JSON
        echo json_encode($response);
    }
    
}
