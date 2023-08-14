<?php

require_once '../models/clientes.php';

if(isset($_GET['operacion'])){

    $cliente = new Clientes();

    if($_GET['operacion'] == 'listar'){
        $data = $cliente->ListarCliente();
        sleep(0.5);
        if($data){
            foreach($data as $registro){
                echo "
                    <tr>
                        <td>{$registro['idcliente']}</td>
                        <td>{$registro['nombres']}</td>
                        <td>{$registro['apellidos']}</td>
                        <td>{$registro['dni']}</td>
                        <td>{$registro['telefono']}</td>
                        <td>
                            <a href='#' class='editar btn btn-outline-warning btn-sm' data-bs-toggle='modal' data-bs-target='#modal-registrar' data-idcliente ='{$registro['idcliente']}'><i class='bi bi-pencil-square'></i></a>
                            <a href='#' class='eliminar btn btn-outline-danger btn-sm' data-idcliente='{$registro['idcliente']}'><i class='bi bi-trash'></i></a> 
                        </td>
                    </tr>
                ";
            }
        }
    }

    if($_GET['operacion'] == 'registrar'){
    
        $datos = [
          "nombres"     => $_GET['nombres'],     
          "apellidos"   => $_GET['apellidos'],
          "dni"         => $_GET['dni'],
          "telefono"    => $_GET['telefono']
        ];
    
        $cliente->RegistrarCliente($datos);
    }

    if ($_GET['operacion'] == 'obtener'){
        $data = $cliente->ObtenerCliente($_GET['idcliente']);

        echo json_encode($data);
    }

    if ($_GET['operacion'] == 'actualizar'){   
        $datos = [
            "idcliente" => $_GET['idcliente'],
            "nombres"   => $_GET['nombres'],     
            "apellidos" => $_GET['apellidos'],
            "dni"       => $_GET['dni'],
            "telefono"  => $_GET['telefono']
        ];

        $cliente->ActualizarCliente($datos);
    }

    if ($_GET['operacion'] == 'eliminar'){
        $cliente->EliminarCliente($_GET['idcliente']);
    }

}
?>