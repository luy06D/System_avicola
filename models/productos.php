<?php

require_once 'conexion.php';

class Producto extends Conexion{
    private $acceso;

    public function __construct()
    {
        $this->acceso = parent::getConnect();
    }

    public function ListarProducto(){
        try{
            $consulta = $this->acceso->prepare("CALL spu_producto_list()");
            $consulta->execute();

            $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datosObtenidos;
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function RegistrarProducto($datos = []){

        try{
            $consulta= $this->acceso->prepare("CALL spu_producto_register(?,?,?)");
            $consulta->execute(
                array(
                    $datos['nombre'],
                    $datos['descripcion'],
                    $datos['cantidad']
                )
            );
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function ObetenerProducto($idproducto = 0){
        try{
            $consulta= $this->acceso->prepare(("CALL spu_producto_obtener(?)"));
            $consulta->execute(array($idproducto));
            return $consulta->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function ActualizarProducto($datos = []){
        try{
            $consulta= $this->acceso->prepare("CALL spu_producto_update(?,?,?,?)");
            $consulta->execute(
                array(
                    $datos['idproducto'],
                    $datos['nombre'],
                    $datos['descripcion'],
                    $datos['cantidad']
                )
            );
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function EliminarProducto($idproducto = 0){
        try{    
            $consulta = $this->acceso->prepare("CALL spu_producto_delete(?)");
            $consulta->execute(array($idproducto));
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
}

?>