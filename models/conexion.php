<?php

class Connection{

    protected $pdo;

    private function Connect(){
        try{
            $connection = new PDO("mysql:host=localhost; port=3306; dbname=avicola ; charset=utf8", "root", "");
            return $connection;
        }
        catch(Exception $err){
            die($err->getMessage());
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