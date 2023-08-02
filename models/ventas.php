<?php

require_once 'conexion.php';

class Ventas extends Conexion{
    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConnect();
    }

    public function RegistrarVentas($datos = []){
        $respuesta = [
            "status" => false,
            "message" => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_ventas_register(?,?,?)");
            $respuesta["status"] = $consulta->execute(array(
                
                $datos["iddetalle_venta"],
                $datos["idusuario"],
                $datos["idcliente"]
            
            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "no se pudo completar la operacion Codigo error:" .$e->getCode();
        }
        return $respuesta;
}

    public function getVentasResume(){
        try{
            $consulta = $this->conexion->prepare("CALL spu_ventas_resume()");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $e) {
            die($e->getMessage());
        }
    }
}