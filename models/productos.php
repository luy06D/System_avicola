<?php

require_once 'conexion.php';

class Productos extends Conexion{
    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConnect();
    }

    public function ListarProducto(){
        try{
          $consulta =  $this->conexion->prepare("CALL spu_producto_list()");
          $consulta->execute();
          $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
          return $tabla;
        }
        catch(Exception $e){
          die($e->getMessage());
        }
    }

    public function RegistrarProducto($datos = []){
        $respuesta = [
            "status" => false,
            "message" => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_producto_register(?,?,?,?)");
            $respuesta["status"] = $consulta->execute(array(
                
                $datos["nombre"],
                $datos["descripcion"],
                $datos["cantidad"],
                $datos["precio"],
            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "no se pudo completar la operacion Codigo error:" .$e->getCode();
        }
        return $respuesta;
    }

    public function ObtenerProducto($idproducto = 0){
        try{
          $consulta = $this->conexion->prepare("CALL spu_producto_obtener(?)");
          $consulta->execute(array($idproducto));
          return $consulta->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
          die($e->getMessage());
        }
    }

    public function ActualizarProducto($datos = []){
        $respuesta = [
            "status" => false,
            "message" => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_producto_update(?,?,?,?,?)");
            $respuesta["status"] = $consulta->execute(array(
                $datos["idproducto"],
                $datos["nombre"],
                $datos["descripcion"],
                $datos["cantidad"],
                $datos["precio"],
            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "no se pudo completar la operacion Codigo error:" .$e->getCode();
        }
        return $respuesta;
    }

    public function EliminarProducto($idproducto = 0){
        $respuesta = [
          "status" => false,
          "message" => ""
        ];
        try{
          $consulta = $this->conexion->prepare("CALL spu_producto_delete(?)");
          $respuesta ["status"] = $consulta->execute(array($idproducto));
        }
        catch(Exception $e){
          $respuesta["message"] = "No se ha podido completar el proceso. Código error: " . $e->getCode();
        }
        return $respuesta;
      }

}