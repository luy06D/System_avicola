<?php

require_once '../models/usuario.php';

if(isset($_POST['operation'])){

    $user = new User();

    if($_POST['operation'] == 'listar'){
        $data = $user->ListarUser();
        if($data){
            foreach($data as $registro){
                echo "
                    <tr>
                        <td>{$registro['idusuario']}</td>
                        <td>{$registro['nombres']}</td>
                        <td>{$registro['apellidos']}</td>
                        <td>{$registro['dni']}</td>
                        <td>{$registro['telefono']}</td>
                        <td>{$registro['nombreusuario']}</td>

                        <td>
                            <a href='#' class='editar btn btn-outline-warning btn-sm' data-bs-toggle='modal' data-bs-target='#modal-registrar' data-idusuario ='{$registro['idusuario']}'><i class='bi bi-pencil-square'></i></a>
                            <a href='#' class='eliminar btn btn-outline-danger btn-sm' data-idusuario='{$registro['idusuario']}'><i class='bi bi-trash'></i></a> 
                        </td>
                    </tr>
                ";
            }
        }
    }
    // <td>{$registro['claveacceso']}</td>

    if($_POST['operation'] == 'UsuariosRegistrar'){

        $dataSave = [
            "nombres"       => $_POST['nombres'],
            "apellidos"     => $_POST['apellidos'],
            "dni"           => $_POST['dni'],
            "telefono"      => $_POST['telefono'],
            "nombreusuario" => $_POST['nombreusuario'],
            "claveacceso"   => password_hash($_POST['claveacceso'], PASSWORD_BCRYPT)
        ];

        $response = $user->usuarios_registrar($dataSave);
        echo json_encode($response);
    }

    if ($_POST['operation'] == 'obtener'){
        $data = $user->ObtenerUser($_POST['idusuario']);

        echo json_encode($data);
    }

    if ($_POST['operation'] == 'actualizar'){   
        $datos = [
            "idusuario" => $_POST['idusuario'],
            "nombres"   => $_POST['nombres'],     
            "apellidos" => $_POST['apellidos'],
            "dni"       => $_POST['dni'],
            "telefono"  => $_POST['telefono'],
            "nombreusuario" => $_POST['nombreusuario'],
            "claveacceso" => password_hash($_POST['claveacceso'], PASSWORD_BCRYPT)
        ];

        $user->ActualizarUser($datos);
    }

    if ($_POST['operation'] == 'eliminar'){
        $user->EliminarUser($_POST['idusuario']);
    }

}

?>