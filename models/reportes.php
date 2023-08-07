<?php

require_once 'conexion.php';

class Reporte extends Conexion{

    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConnect();        
    }

    public function filtroVentas($fechaInicio = "", $fechaFin = ""){
        try{
        $query = $this->conexion->prepare("CALL spu_filtro_ventas (?,?)");
            $query->execute(array($fechaInicio, $fechaFin));

            return $query->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(Exception $err){
            die($err->getMessage());
        }

    }
}

?>