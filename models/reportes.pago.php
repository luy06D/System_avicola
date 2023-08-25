<?php

require_once 'conexion.php';

class ReportePago extends Conexion{

    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConnect();        
    }

    public function recuperarClientes(){
        try{
            $query = $this->conexion->prepare("CALL spu_clientes_recuperar()");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $err){
            die($err->getMessage());
        }
    }
    
    public function filtropagofecha($fechaInicio = "", $fechaFin = ""){
        try{
        $query = $this->conexion->prepare("CALL spu_filtro_ClienteFecha (?,?)");
            $query->execute(array($fechaInicio, $fechaFin));

            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $err){
            die($err->getMessage());
        }

    }

    public function filtropagocliente($idcliente = 0){
        try{
        $query = $this->conexion->prepare("CALL spu_filtro_clientePago (?)");
            $query->execute(array($idcliente));

            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $err){
            die($err->getMessage());
        }

    }

    public function filtropagoclientefecha($fechaInicio = "", $fechaFin = "", $idcliente = 0){
        try{
        $query = $this->conexion->prepare("CALL spu_filtro_pagoclientefecha (?,?,?)");
            $query->execute(array($fechaInicio, $fechaFin, $idcliente));

            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $err){
            die($err->getMessage());
        }

    }

    public function filtropagodetallecliente($idcliente = 0){
        try{
        $query = $this->conexion->prepare("CALL spu_listar_detallesclientes (?)");
            $query->execute(array($idcliente));

            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $err){
            die($err->getMessage());
        }

    }

}

?>