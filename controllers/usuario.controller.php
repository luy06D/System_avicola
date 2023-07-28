<?php

require_once '../models/usuario.php';

if(isset($_GET['operation'])){

    $user = new User();

    if($_GET['operation'] == 'destroy'){
        session_destroy();
        session_unset();
        header('Location:../index.php');
    }

    if($_GET['operation'] == 'log_in'){

        $access = [
            "login"         => false,
            "apellidos"     => "",
            "nombres"       => "",
            "nombreusuario" => "",
            "mensaje"       => ""
        ];

        $data = $user->login($_GET['user']);
        $keyIngresada = $_GET['claveacceso'];

        if($data){

            if(password_verify($keyIngresada, $data['claveacceso'])){

                $access["login"] = true;
                $access["apellidos"] = $data["apellidos"];
                $access["nombres"] = $data["nombres"];
                $access["nombreusuario"] = $data["nombreusuario"];
            }else{
                $access["mensaje"] = "Contraseña";
            }
        }else{
            $access["mensaje"] = "Usuario";
        }

        $_SESSION['segurity'] = $access;

        echo json_encode($access);
    }


}

?>