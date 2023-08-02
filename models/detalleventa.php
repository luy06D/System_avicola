<?php

require_once 'conexion.php';

class DetalleVentas extends Conexion{
    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConnect();
    }

    public function RegistrarDetalleVentas($datos = []){
        $respuesta = [
            "status" => false,
            "message" => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_detalleventas_register(?,?,?)");
            $respuesta["status"] = $consulta->execute(array(
                
                $datos["idproducto"],
                $datos["idcantidad"]
            
            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "no se pudo completar la operacion Codigo error:" .$e->getCode();
        }
        return $respuesta;
}

}