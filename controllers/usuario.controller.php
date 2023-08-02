<?php

session_start();

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
            "idusuario"     => "",         
            "mensaje"       => ""
        ];

        $data = $user->login($_GET['nombreusuario']);
        $keyIngresada = $_GET['claveacceso'];

        if($data){

            if(password_verify($keyIngresada, $data['claveacceso'])){

                $access["login"] = true;
                $access["apellidos"] = $data["apellidos"];
                $access["nombres"] = $data["nombres"];
                $access["nombreusuario"] = $data["nombreusuario"];
                $access["idusuario"] = $data["idusuario"];

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