<?php

require_once 'conexion.php';

class User extends Conexion{

    private $access;

    public function __CONSTRUCT(){
        $this->access = parent::getConnect();
    }

    public function login ($nombreusuario = ""){
        try{
            $query = $this->access->prepare("CALL spu_user_login(?)");
            $query->execute(array($nombreusuario));

            return  $query->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $err){
            die($err->getMessage());

        }    
    }

    public function usuarios_registrar($data = []){

        $response = [
            "status" => false,
            "message" => ""
        ];

        try{
            $query = $this->access->prepare("CALL spu_usuario_registar(?,?,?,?,?,?)");
            $response["status"] = $query->execute(array(

                $data['nombres'],
                $data['apellidos'],
                $data['dni'],
                $data['telefono'],
                $data['nombreusuario'],
                $data['claveacceso']
            ));

        }
        catch(Exception $err){
            $response["message"] = "No se completo el proceso. Codigo error: " . $err->getCode(); 
        }
        return $response;
    }


    public function ListarUser(){
        try{
            $consulta =  $this->access->prepare("CALL spu_user_list()");
            $consulta->execute();
            $tabla = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $tabla;
        }
            catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function ObtenerUser($idusuario= 0){
        try{
          $consulta = $this->access->prepare("CALL spu_user_obtener(?)");
          $consulta->execute(array($idusuario));
          return $consulta->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
          die($e->getMessage());
        }
    }

    public function ActualizarUser($datos = []){
        $respuesta = [
            "status" => false,
            "message" => ""
        ];
        try{
            $consulta = $this->access->prepare("CALL spu_user_update(?,?,?,?,?,?,?)");
            $respuesta["status"] = $consulta->execute(array(

                $datos["idusuario"],
                $datos["nombres"],
                $datos["apellidos"],
                $datos["dni"],
                $datos["telefono"],
                $datos["nombreusuario"],
                $datos["claveacceso"]
            ));
        }
        catch(Exception $e){
            $respuesta["message"] = "no se pudo completar la operacion Codigo error:" .$e->getCode();
        }
        return $respuesta;
    }

    public function EliminarUser($idusuario = 0){
      $respuesta = [
        "status" => false,
        "message" => ""
      ];
      try{
        $consulta = $this->access->prepare("CALL spu_user_delete(?)");
        $respuesta ["status"] = $consulta->execute(array($idusuario));
      }
      catch(Exception $e){
        $respuesta["message"] = "No se ha podido completar el proceso. Código error: " . $e->getCode();
      }
      return $respuesta;
    }

}


?>