<?php
require_once '../models/productos.php';

if (isset($_POST['operacion'])){

    $producto = new Productos();

    if($_POST['operacion'] == 'listar'){
        $datos = $producto->ListarProducto();
        
        if($datos){
          foreach($datos as $registro){
            echo "
                <tr>
                    <td>{$registro['idproducto']}</td>
                    <td>{$registro['nombre']}</td>
                    <td>{$registro['descripcion']}</td>
                    <td>{$registro['cantidad']}</td>
                    <td>{$registro['precio']}</td>
                    <td >
                      <a href='#' class='eliminar btn btn-outline-danger btn-sm' data-idproducto='{$registro['idproducto']}'>Eliminar</a> 
                      <a href='#' class='editar btn btn-outline-info btn-sm' data-bs-toggle='modal' data-bs-target='#modal-producto' data-idproducto ='{$registro['idproducto']}'>Editar</a>
                    </td>
                </tr>
            ";
          }
        }
    }

    if($_POST['operacion'] == 'registrar'){
        $datosGuardar = [
            "nombre"        => $_POST['nombre'],   
            "descripcion"   => $_POST['descripcion'],
            "cantidad"      => $_POST['cantidad'],
            "precio"        => $_POST['precio']
        ];
        $respuesta = $producto->RegistrarProducto($datosGuardar);
        echo json_encode($respuesta);
    }

    if($_POST['operacion'] == 'obtener'){
        $respuesta = $producto->ObtenerProducto($_POST['idproducto']);
        echo json_encode($respuesta);
    }

    if($_POST['operacion'] == 'actualizar'){
        $datosActualizar = [
          "idproducto"       => $_POST['idproducto'],
          "nombre"           => $_POST['nombre'],
          "descripcion"      => $_POST['descripcion'],
          "cantidad"         => $_POST['cantidad'],
          "precio"           => $_POST['precio']
        ];
    
        $respuesta = $producto->ActualizarProducto($datosActualizar);
        echo json_encode($respuesta);
    }

    if($_POST['operacion'] == 'eliminar'){
        $respuesta = $producto->EliminarProducto($_POST['idproducto']);
        echo json_encode($respuesta);
      } 
}