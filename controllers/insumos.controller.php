<?php

require_once '../models/insumos.php';

if(isset($_GET['operacion'])){

    $insumos = new Insumo();

    if($_GET['operacion'] === 'showInsumos'){
        $data = $insumos->show_Insumos();
        if($data){
            foreach($data as $registro){
                echo "
                <tr>
                    <td>{$registro['idinsumo']}</td>
                    <td>{$registro['insumo']}</td>
                    <td>{$registro['cantidad']}</td>
                    <td>{$registro['detalle']}</td>                    

                    <td>
                        <a href='#' class='editar btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#modal-registrar' data-idinsumo ='{$registro['idinsumo']}'><i class='bi bi-pencil-square'></i></a>
                        <a href='#' class='eliminar btn btn-danger btn-sm' data-idinsumo='{$registro['idinsumo']}'><i class='bi bi-trash'></i></a>
                        <a href='#' class='add btn btn-success btn-sm' data-bs-toggle='modal' data-bs-target='#modal-registrar-insu' data-idinsumo ='{$registro['idinsumo']}'><i class='bi bi-plus-circle-dotted'></i></a>
                    </td>
                </tr>
            ";

            }
        }
    }

    if ($_GET['operacion'] == 'eliminar'){
        $insumos->delete_insumo($_GET['idinsumo']);
    }


}

if(isset($_POST['operacion'])){
    
    $insumos = new Insumo();

    if($_POST['operacion'] == 'insumosRegister'){

        $saveData = [
            "insumo"        => $_POST['insumo'], 
            "unidad"        => $_POST['unidad'],   
            "cantidad"      => $_POST['cantidad'],
            "descripcion"   => $_POST['descripcion']
            
        ];

        $respuesta = $insumos->insumo_register($saveData);
        echo json_encode($respuesta);
    }


    if($_POST['operacion'] == 'insumosUpdate'){

        $saveData = [
            "idinsumo"        => $_POST['idinsumo'], 
            "insumo"        => $_POST['insumo'], 
            "unidad"        => $_POST['unidad'],   
            "cantidad"      => $_POST['cantidad'],
            "descripcion"   => $_POST['descripcion']
            
        ];

       $insumos->insumo_update($saveData);
  
        
    }

    if ($_POST['operacion'] == 'actualizar_stock') {
        $saveData = [
            "idinsumo"      => $_POST['idinsumo'],  
            "cantidadtn"    => $_POST['cantidadtn'],
            "cantidadsacos"  => $_POST['cantidadsacos'],
            "precio"        => $_POST['precio'],
            "fecha_entrada" => $_POST['fecha_entrada'],
            "detalle"       => $_POST['detalle']
            
        ];
        $resultado = $insumos->insumo_add($saveData);
        header('Content-Type: application/json');
    
        if ($resultado["status"]) {
            $response = array(
                'status' => true,
                'mensaje' => 'Operación exitosa'
            );
        } else {
            $response = array(
                'status' => false,
                'mensaje' => 'La operación falló'
            );
        }
        echo json_encode($response);
    }
        
    if($_POST['operacion'] == 'getInsumo'){
        $data = $insumos->get_insumo($_POST['idinsumo']);
        echo json_encode($data);
    }   

}

?>