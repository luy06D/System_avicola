<?php

require_once 'conexion.php';

class Formula extends Conexion{

    private $access;

    public function __CONSTRUCT(){
        $this->access = parent::getConnect();
    }


    public function getFormulas(){
        try{
            $consulta = $this->access->prepare("CALL spu_getFormula()");
            $consulta->execute();

            $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datosObtenidos;
        }
        catch(Exception $e){
            die($e->getMessage());
       
        }

    }

    public function getInsumos(){
        try{
            $consulta = $this->access->prepare("CALL spu_getInsumo()");
            $consulta->execute();

            $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datosObtenidos;
        }
        catch(Exception $e){
            die($e->getMessage());
       
        }

    }



    
    public function formula_registrar($datos = []){

        $respuesta = [
            "status" => false,
            "message" => ""
        ];

        try{
            $consulta = $this->access->prepare("CALL spu_formula_registrar  (?)");
            $respuesta["status"] = $consulta->execute(array(
                
                $datos["nombreformula"]
            
            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "No se pudo completar la operacion Codigo error:" .$e->getCode();
        }

        return $respuesta;
    }

    public function detalle_registrar($datos = []){

        $respuesta = [
            "status" => false,
            "message" => ""
        ];

        try{
            $consulta = $this->access->prepare("CALL spu_detalleInsumo_registrar(?,?,?,?)");
            $respuesta["status"] = $consulta->execute(array(
                
                $datos["idformula"],
                $datos["idinsumo"],
                $datos["cantidad"],
                $datos["unidad"]
            
            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "No se pudo completar la operacion Codigo error:" .$e->getCode();
        }

        return $respuesta;
    }


    public function obtener_formula($idformula = 0){
        try{
          $consulta = $this->access->prepare("CALL spu_listar_detalleF(?)");
          $consulta->execute(array($idformula));
          return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
          die($e->getMessage());
        }
    }


}


?>