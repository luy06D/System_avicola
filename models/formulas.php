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
    
        try {
            $consulta = $this->access->prepare("CALL spu_detalleInsumo_registrar(?,?,?)");
            $respuesta["status"] = $consulta->execute(array(
                
                $datos["idformula"],
                $datos["idinsumo"],
                $datos["cantidad"]

            
            ));
        } catch (Exception $e) {
            $respuesta["message"] = "No se pudo completar la operación. Código de error: " . $e->getCode();
            error_log("Error en detalle_registrar: " . $e->getMessage());
        }
    
        return $respuesta;
    }


    public function descontar_detalle($datos = []){

        $respuesta = [
            "status" => false,
            "message" => ""
        ];
    
        try {
            $consulta = $this->access->prepare("CALL spu_descontar_insumo(?,?,?,?)");
            $respuesta["status"] = $consulta->execute(array(
                
                $datos["idformula"],
                $datos["idinsumo"],
                $datos["cantidadtn"],
                $datos["cantidadsacos"]
            
            ));
        } catch (Exception $e) {
            $respuesta["message"] = "No se pudo completar la operación. Código de error: " . $e->getCode();
            error_log("Error en detalle_registrar: " . $e->getMessage());
        }
    
        return $respuesta;
    }





    public function obtener_formula($idformula = 0, $cantidadtn = 0, $cantidadsacos = 0){
        $respuesta = [
            "message" => ""
        ];
        try{
          $consulta = $this->access->prepare("CALL spu_listar_detalleF(?,?,?)");
          $consulta->execute(array($idformula, $cantidadtn, $cantidadsacos));
          return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
          $respuesta["message"] = "No se pudo completar la operacion Codigo error:" .$e->getCode();
        }
        return $respuesta;
    }

    public function obtener_formula1($idformula = 0, $idinsumo= 0, ){
        $respuesta = [
            "message" => ""
        ];
        try{
          $consulta = $this->access->prepare("CALL spu_listar_detalleF(?,?)");
          $consulta->execute(array($idformula, $idinsumo));
          return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
          $respuesta["message"] = "No se pudo completar la operacion Codigo error:" .$e->getCode();
        }
        return $respuesta;
    }

    public function get_detalleI($iddetalle_insumo = 0){
        try{
          $consulta = $this->access->prepare("CALL spu_getdetalleI(?)");
          $consulta->execute(array($iddetalle_insumo));
          return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
          die($e->getMessage());
        }
    }

    public function formula_delete($idformula = 0){
        try{
          $consulta = $this->access->prepare("CALL spu_formulaDelete(?)");
          $consulta->execute(array($idformula));

        }
        catch(Exception $e){
          die($e->getMessage());
        }
    }



    public function detalleInsumo_update($datos = []){

        $respuesta = [
            "status" => false,
            "message" => ""
        ];

        try{
            $consulta = $this->access->prepare("CALL spu_detalleInsumo_update(?,?,?)");
            $respuesta["status"] = $consulta->execute(array(
                
                $datos["iddetalle_insumo"],
                $datos["idinsumo"],

            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "No se pudo completar la operacion Codigo error:" .$e->getCode();
        }

        return $respuesta;
    }


    public function filtrosinsumosfor($idformula = 0){
        try{
        $query = $this->access->prepare("CALL spu_listar_insumos_por_formula(?)");
            $query->execute(array($idformula));

            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $err){
            die($err->getMessage());
        }

    }







}


?>