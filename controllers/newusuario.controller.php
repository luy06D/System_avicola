<?php

require_once '../models/usuario.php';

if(isset($_POST['operation'])){

    $user = new User();

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

}

?>