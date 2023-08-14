<?php

require_once '../models/productos.php';

if(isset($_GET['operacion'])){

    $producto = new Producto();

    if($_GET['operacion'] == 'listar'){
        $data = $producto->ListarProducto();
        sleep(0.5);
        if($data){
            foreach($data as $registro){
                echo "
                    <tr>
                        <td>{$registro['idproducto']}</td>
                        <td>{$registro['nombre']}</td>
                        <td>{$registro['descripcion']}</td>
                        <td>
                            <a href='#' class='editar btn btn-outline-warning btn-sm' data-bs-toggle='modal' data-bs-target='#modal-registrar' data-idproducto ='{$registro['idproducto']}'><i class='bi bi-pencil-square'></i></a>
                            <a href='#' class='eliminar btn btn-outline-danger btn-sm' data-idproducto='{$registro['idproducto']}'><i class='bi bi-trash'></i></a> 
                        </td>
                    </tr>
                ";
            }
        }
    }

    // <td>{$registro['cantidad']}</td>

    if($_GET['operacion'] == 'registrar'){
    
        $datos = [
          "nombre"      => $_GET['nombre'],     
          "descripcion" => $_GET['descripcion']
        ];
    
        $producto->RegistrarProducto($datos);
    }

    if ($_GET['operacion'] == 'obtener'){
        $data = $producto->ObetenerProducto($_GET['idproducto']);

        echo json_encode($data);
    }

    if ($_GET['operacion'] == 'actualizar'){   
        $datos = [
            "idproducto"  => $_GET['idproducto'],
            "nombre"      => $_GET['nombre'],     
            "descripcion" => $_GET['descripcion']
        ];

        $producto->ActualizarProducto($datos);
    }

    if ($_GET['operacion'] == 'eliminar'){
        $producto->EliminarProducto($_GET['idproducto']);
    }

}
?>