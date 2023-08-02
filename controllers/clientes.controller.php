<?php
require_once '../models/clientes.php';

if (isset($_POST['operacion'])){

    $cliente= new Clientes();

    if($_POST['operacion'] == 'listar'){
        $datos = $cliente->ListarCliente();
        
        if($datos){
          foreach($datos as $registro){
            echo "
                <tr>
                    <td>{$registro['idcliente']}</td>
                    <td>{$registro['nombres']}</td>
                    <td>{$registro['apellidos']}</td>
                    <td>{$registro['dni']}</td>
                    <td>{$registro['telefono']}</td>
                    <td >
                      <a href='#' class='eliminar btn btn-outline-danger btn-sm' data-idcliente='{$registro['idcliente']}'>Eliminar</a> 
                      <a href='#' class='editar btn btn-outline-info btn-sm' data-bs-toggle='modal' data-bs-target='#modal-cliente' data-idcliente ='{$registro['idcliente']}'>Editar</a>
                    </td>
                </tr>
            ";
          }
        }
    }

    if($_POST['operacion'] == 'registrar'){
        $datosGuardar = [
            "nombres"       => $_POST['nombres'],   
            "apellidos"     => $_POST['apellidos'],
            "dni"           => $_POST['dni'],
            "telefono"      => $_POST['telefono']
        ];
        $respuesta = $cliente->RegistrarCliente($datosGuardar);
        echo json_encode($respuesta);
    }

    if($_POST['operacion'] == 'obtener'){
        $respuesta = $cliente->ObtenerCliente($_POST['idcliente']);
        echo json_encode($respuesta);
    }

    if($_POST['operacion'] == 'actualizar'){
        $datosActualizar = [
          "idcliente"       => $_POST['idcliente'],
          "nombres"         => $_POST['nombres'],
          "apellidos"       => $_POST['apellidos'],
          "dni"             => $_POST['dni'],
          "telefono"        => $_POST['telefono']
        ];
    
        $respuesta = $cliente->ActualizarCliente($datosActualizar);
        echo json_encode($respuesta);
    }

    if($_POST['operacion'] == 'eliminar'){
        $respuesta = $cliente->EliminarCliente($_POST['idcliente']);
        echo json_encode($respuesta);
    } 
}