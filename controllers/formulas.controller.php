<?php

require_once '../models/formulas.php';

if(isset($_POST['operacion'])){

    $formulas = new Formula();

    
    if($_POST['operacion'] == 'getformula'){
        echo json_encode($formulas->getFormulas());
    }

    if($_POST['operacion'] == 'getInsumo'){
        echo json_encode($formulas->getInsumos());
    }


     
    if($_POST['operacion'] == 'formula_registrar'){
        
        $dataSave =[
            "nombreformula" => $_POST['nombreformula']

        ];

        $response = $formulas->formula_registrar($dataSave);
        echo json_encode($response);
    }

    if($_POST['operacion'] == 'detalle_registrar'){
        
        $dataSave =[
            "idformula" => $_POST['idformula'],
            "idinsumo" => $_POST['idinsumo'],
            "cantidad" => $_POST['cantidad'],
            "unidad"   => $_POST['unidad'],

        ];

        $response = $formulas->detalle_registrar($dataSave);
        echo json_encode($response);
    }


        
    if($_POST['operacion'] == 'obtener_formula'){
        $data = $formulas->obtener_formula($_POST['idformula']);
        echo json_encode($data);
    }

    
    if ($_POST['operacion'] == 'formula_eliminar'){
        $formulas->formula_delete($_POST['idformula']);
    }




    if($_POST['operacion'] == 'detalle_update'){
        
        $dataSave =[
            "iddetalle_insumo" => $_POST['iddetalle_insumo'],
            "idinsumo" => $_POST['idinsumo'],
            "cantidad" => $_POST['cantidad'],
            "unidad"   => $_POST['unidad'],

        ];

        $response = $formulas->detalleInsumo_update($dataSave);
        echo json_encode($response);
    }

}


if(isset($_GET['operacion'])){

    $formulas = new Formula();

                
    if($_GET['operacion'] == 'obtener_detalleI'){
        $data = $formulas->get_detalleI($_GET['iddetalle_insumo']);
        echo json_encode($data);
    }

    
}




?>