<?php

class Cuenta 
{

    function __construct(){

        require_once 'conexion.php';
        $this->conn = new Conexion;
        $this->cid = $this->conn->conectar();
        
    }

    public function insertarMovimiento ($nroSucursal,$tipoMovimiento,$importe,$observacion) {
                
        $dbh = $this->cid;

        $stmt = $dbh->prepare("INSERT INTO ph_movimiento_cuenta ( nro_sucursal, tipo_movimiento, importe,observaciones) VALUES (?,?,?,?);");
        $hourMin = date('Hi');
        $stmt->bindParam(1, $nroSucursal);
        $stmt->bindParam(2, $tipoMovimiento);
        $stmt->bindParam(3, $importe);
        $stmt->bindParam(4, $observacion);

        try {

            $stmt->execute();
            return ;

        }catch (\Throwable $th) {

            return $th;

        }

    } 
    public function getAll ($nroSucursal) {
                
        $dbh = $this->cid;

        $stmt = $dbh->prepare(" SELECT * FROM ph_movimiento_cuenta where nro_sucursal = $nroSucursal ");
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