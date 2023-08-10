<?php

require_once 'conexion.php';

class Reporte extends Conexion{

    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConnect();        
    }

    public function filtro2Ventas($fechaInicio = "", $fechaFin = ""){
        try{
        $query = $this->conexion->prepare("CALL spu_filtro2_ventas (?,?)");
            $query->execute(array($fechaInicio, $fechaFin));

            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $err){
            die($err->getMessage());
        }

    }

    public function filtro3Ventas($fechaInicio = "", $fechaFin = "", $idcliente = 0){
        try{
        $query = $this->conexion->prepare("CALL spu_filtro3_ventas (?,?,?)");
            $query->execute(array($fechaInicio, $fechaFin, $idcliente));

            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $err){
            die($err->getMessage());
        }

    }

    public function filtro1Ventas($idcliente = 0){
        try{
        $query = $this->conexion->prepare("CALL spu_filtro1_ventas (?)");
            $query->execute(array($idcliente));

            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $err){
            die($err->getMessage());
        }

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
}

?>