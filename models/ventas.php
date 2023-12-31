<?php

require_once 'conexion.php';

class Ventas extends Conexion{

    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConnect();
    }

    public function ventas_registrar($datos = []){

        $respuesta = [
            "status" => false,
            "message" => ""
        ];

        try{
            $consulta = $this->conexion->prepare("CALL spu_ventas_register(?,?,?,?,?,?,?,?,?)");
            $respuesta["status"] = $consulta->execute(array(
                
                $datos["idproducto"],
                $datos["cantidad"],
                $datos["idusuario"],
                $datos["idcliente"],
                $datos["kilos"],
                $datos["precio"],
                $datos["flete"],
                $datos["deuda"],
                $datos["paquetes"]

            
            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "No se pudo completar la operacion Codigo error:" .$e->getCode();
        }

        return $respuesta;
    }

    public function recuperarProductos(){
        try{
            $query = $this->conexion->prepare("CALL spu_productos_recuperar()");
            $query->execute();
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

    public function Grafico2(){
        try{
            $consulta = $this->conexion->prepare("CALL spu_resume_ventas()");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $e) {
            die($e->getMessage());
        }
    }

    
    public function obtener_ultimaV(){
        try{
            $consulta = $this->conexion->prepare("CALL spu_obtener_ultimaV()");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function obtener_detalleV($idventa = 0){
        try{
          $consulta = $this->conexion->prepare("CALL spu_obtener_detalleV(?)");
          $consulta->execute(array($idventa));
          return $consulta->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
          die($e->getMessage());
        }
    }

    

  
}