<?php

require_once 'conexion.php';

class Insumo extends Conexion{

    private $access;

    public function __CONSTRUCT(){
        $this->access = parent::getConnect();
    }


    public function show_Insumos(){
        try{
            $consulta = $this->access->prepare("CALL spu_insumos_listar()");
            $consulta->execute();

            $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datosObtenidos;
        }
        catch(Exception $e){
            die($e->getMessage());
       
        }

    }

    public function insumo_register($data = []){

        $respuesta = [
            "status" => false,
            "message" => ""
        ];

        try{
            $consulta = $this->access->prepare("CALL spu_insumos_register(?,?,?,?)");
            $respuesta["status"] = $consulta->execute(array(
                
                $data["insumo"],
                $data["unidad"],
                $data["cantidad"],
                $data["descripcion"]
           
            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "No se pudo completar la operacion Codigo error:" .$e->getCode();
        }

        return $respuesta;

    }


    public function insumo_update($data = []){

        $respuesta = [
            "status" => false,
            "message" => ""
        ];

        try{
            $consulta = $this->access->prepare("CALL spu_insumos_update(?,?,?,?,?)");
            $respuesta["status"] = $consulta->execute(array(

                $data["idinsumo"],
                $data["insumo"],
                $data["unidad"],
                $data["cantidad"],
                $data["descripcion"]
           
            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "No se pudo completar la operacion Codigo error:" .$e->getCode();
        }

        return $respuesta;

    }

    public function insumo_add($datos = []) {
        $respuesta = [
            "status" => false,
            "message" => ""
        ];

        try{
            $consulta = $this->access->prepare("call sp_registrar_entrada(?,?,?,?,?,?)");
            $respuesta["status"] = $consulta->execute(array(
                
                $datos["idinsumo"],
                $datos["cantidadtn"],
                $datos["cantidadsaco"],
                $datos["precio"],
                $datos["fecha_entrada"],
                $datos["detalle"]
           
            ));
    
            $respuesta["status"] = true;
        } catch (Exception $e) {
            $respuesta["message"] = "No se pudo completar la operación Codigo error:" . $e->getCode();
        }
    
        return $respuesta;
    }

    

    public function get_insumo($idinsumo = 0){
        try{
          $consulta = $this->access->prepare("CALL spu_get_insumo(?)");
          $consulta->execute(array($idinsumo));
          return $consulta->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
          die($e->getMessage());
        }
    }

    public function delete_insumo($idinsumo = 0){
        try{    
            $consulta = $this->access->prepare("CALL spu_delete_insumo(?)");
            $consulta->execute(array($idinsumo));
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

}


?>