<?php

require_once 'conexion.php';

class User extends Conexion{

    private $access;

    public function __CONSTRUCT(){
        $this->access = parent::getConnect();
    }

    public function login ($user = ""){
        try{
            $query = $this->access->prepare("");
            $query->execute(array($user));

            return  $query->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $err){
            die($err->getMessage());

        }
    }
}

?>