<?php

require_once 'conexion.php';

class Clientes extends Conexion{
    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConnect();
    }

    public function ListarCliente(){
        try{
          $consulta =  $this->conexion->prepare("CALL spu_clientes_list()");
          $consulta->execute();
          $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
          return $tabla;
        }
        catch(Exception $e){
          die($e->getMessage());
        }
    }

    public function RegistrarCliente($datos = []){
        $respuesta = [
            "status" => false,
            "message" => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_cliente_register(?,?,?,?)");
            $respuesta["status"] = $consulta->execute(array(
                
                $datos["nombres"],
                $datos["apellidos"],
                $datos["dni"],
                $datos["telefono"],
            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "no se pudo completar la operacion Codigo error:" .$e->getCode();
        }
        return $respuesta;
    }

    public function ObtenerCliente($idcliente = 0){
        try{
          $consulta = $this->conexion->prepare("CALL spu_cliente_obtener(?)");
          $consulta->execute(array($idcliente));
          return $consulta->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
          die($e->getMessage());
        }
    }

    public function ActualizarCliente($datos = []){
        $respuesta = [
            "status" => false,
            "message" => ""
        ];
        try{
            $consulta = $this->conexion->prepare("CALL spu_cliente_update(?,?,?,?,?)");
            $respuesta["status"] = $consulta->execute(array(
                $datos["idcliente"],
                $datos["nombres"],
                $datos["apellidos"],
                $datos["dni"],
                $datos["telefono"],
            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "no se pudo completar la operacion Codigo error:" .$e->getCode();
        }
        return $respuesta;
    }

    public function EliminarCliente($idcliente = 0){
        $respuesta = [
          "status" => false,
          "message" => ""
        ];
        try{
          $consulta = $this->conexion->prepare("CALL spu_cliente_delete(?)");
          $respuesta ["status"] = $consulta->execute(array($idcliente));
        }
        catch(Exception $e){
          $respuesta["message"] = "No se ha podido completar el proceso. Código error: " . $e->getCode();
        }
        return $respuesta;
      }

}