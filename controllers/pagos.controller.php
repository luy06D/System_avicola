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
                        <td>{$registro['nombre']}</td>
                        <td>{$registro['deuda_total']}</td>
                        <td>{$registro['pago_total']}</td>
                        <td>{$registro['saldo']}</td>
                        <td>{$registro['estado']}</td>
                        <td>
                            <a href='#'  class='abonar btn btn-outline-warning btn-sm' data-bs-toggle='modal' data-bs-target='#modal-registrar' data-idventa='{$registro['idventa']}'><i class='bi bi-pencil-square'></i></a>
                        </td>
                    </tr>
                ";
            }
        }
    }

    if($_GET['operacion'] == 'registrar'){
    
        $datos = [
          "idventa"       => $_GET['idventa'],     
          "banco"         => $_GET['banco'],
          "numoperacion"  => $_GET['numoperacion'],
          "pago"          => $_GET['pago']
        ];
            $pagos->RegistrarPagos($datos);
    }

    if ($_GET['operacion'] == 'obtener'){
        $data = $cliente->ObtenerCliente($_GET['idventa']);

        echo json_encode($data);
    }
}

