<?php

require_once 'conexion.php';

class Pagos extends Conexion{
    private $acceso;

    public function __construct()
    {
        $this->acceso = parent::getConnect();
    }

    public function ListarPagos(){
        try{
            $consulta = $this->acceso->prepare("CALL spu_ventas_mostrar()");
            $consulta->execute();

            $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $datosObtenidos;
        }catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function RegistrarPagos($datos = []){
        try{
            $consulta = $this->acceso->prepare("CALL spu_pagos_registrar(?,?,?,?)");
            $consulta->execute(
                array(
                    $datos['idventa'],
                    $datos['banco'],
                    $datos['numoperacion'],
                    $datos['pago']
                )
            );
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    public function ObtenerPago($idventa = 0){
        try{
          $consulta = $this->acceso->prepare("CALL spu_cliente_obtener(?)");
          $consulta->execute(array($idventa));
          return $consulta->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
          die($e->getMessage());
        }
    }

}