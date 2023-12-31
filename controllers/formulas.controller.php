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

        ];

        $response = $formulas->detalle_registrar($dataSave);
        echo json_encode($response);
    }
    
   
    if ($_POST['operacion'] == 'descontar_insumos') {
        $data = json_decode($_POST['datos'], true); // Decodificar el array de objetos
        
        $responses = array(); // Almacenar las respuestas de registro
        
        $errorFound = false; // Inicializar la variable para errores
        
        foreach ($data as $dataSave) {
            try {
                $response = $formulas->descontar_detalle($dataSave); // Supongamos que esta función registra un objeto
                
                // Verificar el estado de la respuesta
                if (!$response['status']) {
                    $errorFound = true; // Establecer errorFound en true
                    break; // Detener el bucle inmediatamente al encontrar un error
                }
                
                $responses[] = $response;
            } catch (Exception $e) {
                // Manejo de errores
                $responses[] = array(
                    "status" => false,
                    "message" => "No se pudo completar la operación. Código de error: " . $e->getCode(),
                );
                $errorFound = true; // Establecer errorFound en true
                error_log("Error en detalle_registrar: " . $e->getMessage());
                break; // Detener el bucle inmediatamente al encontrar un error
            }
        }
    
        // Verificar si se encontraron errores
        if ($errorFound) {
            // Mostrar una alerta SweetAlert2 de error si al menos una operación falló
            echo json_encode(array(
                "status" => false,
                "message" => "No se pudo completar la operación. Verifique las cantidades de insumos."
            ));
        } else {
            // Todas las operaciones se ejecutaron con éxito
            echo json_encode(array(
                "status" => true,
                "message" => "Los datos se han registrado correctamente."
            ));
        }
    }
    
    


 
        

        
    if($_POST['operacion'] == 'obtener_formula'){
        $data = $formulas->obtener_formula($_POST['idformula'],$_POST['cantidadtn'],$_POST['cantidadsacos']);
        echo json_encode($data);
    }

    if($_POST['operacion'] == 'obtener_formula1'){
        $data = $formulas->obtener_formula1($_POST['idformula'],$_POST['idinsumo']);
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

        ];

        $response = $formulas->detalleInsumo_update($dataSave);
        echo json_encode($response);
    }

    if($_POST['operacion'] == 'filtro_formu'){
        $data = $formulas->filtrosinsumosfor($_POST['idformula']);
        echo json_encode($data);
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