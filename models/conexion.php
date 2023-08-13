<?php

class Conexion{

    private function Connect(){
        try{
            $pdo = new PDO("mysql:host=localhost; port=3306; dbname=avicola; charset=UTF8", "root", "");
            return $pdo;
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }


    public function getConnect(){
    try{

        $pdo = $this->Connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;

    }
    catch(Exception $err){
        die($err->getMessage());
    }

}

}


?>