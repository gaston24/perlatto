<?php

class Cuenta 
{

    function __construct(){

        require_once 'conexion.php';
        $this->conn = new Conexion;
        $this->cid = $this->conn->conectar();
        
    }

    public function insertarMovimiento ($nroSucursal,$tipoMovimiento,$importe,$observacion,$idTipo) {
                
        $dbh = $this->cid;

        $stmt = $dbh->prepare("INSERT INTO ph_movimiento_cuenta ( nro_sucursal, tipo_movimiento, importe,observaciones,franquicia_fabrica) VALUES (?,?,?,?,?);");
        $hourMin = date('Hi');
        $stmt->bindParam(1, $nroSucursal);
        $stmt->bindParam(2, $tipoMovimiento);
        $stmt->bindParam(3, $importe);
        $stmt->bindParam(4, $observacion);
        $stmt->bindParam(5, $idTipo);

        try {

            $stmt->execute();
            return ;

        }catch (\Throwable $th) {

            return $th;

        }

    } 
    public function getFranquicia ($nroSucursal) {
                
        $dbh = $this->cid;

        $stmt = $dbh->prepare(" SELECT * FROM ph_movimiento_cuenta where nro_sucursal = $nroSucursal AND franquicia_fabrica = 1 ");
        $hourMin = date('Hi');
 
        try {

            $stmt->execute();
            $datos = $stmt->fetchAll(); 
            return $datos;

        }catch (\Throwable $th) {

            return $th;

        }

    } 

    public function getFabrica ($nroSucursal) {
                
        $dbh = $this->cid;

        $stmt = $dbh->prepare(" SELECT * FROM ph_movimiento_cuenta where franquicia_fabrica = 0 AND nro_sucursal = $nroSucursal ");
        $hourMin = date('Hi');
 
        try {

            $stmt->execute();
            $datos = $stmt->fetchAll(); 
            return $datos;

        }catch (\Throwable $th) {

            return $th;

        }

    } 

    public function getDetalle ($nroSucursal,$idTipo) {
                
        $dbh = $this->cid;

        $stmt = $dbh->prepare(" SELECT * FROM ph_movimiento_cuenta where nro_sucursal = $nroSucursal and franquicia_fabrica = $idTipo ");
        $hourMin = date('Hi');
 
        try {

            $stmt->execute();
            $datos = $stmt->fetchAll(); 
            return $datos;

        }catch (\Throwable $th) {

            return $th;

        }

    } 



}