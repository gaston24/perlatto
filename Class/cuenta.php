<?php

class Cuenta 
{

    function __construct(){

        require_once 'conexion.php';
        $this->conn = new Conexion;
        $this->cid = $this->conn->conectar();
        
    }

    public function insertarMovimiento ($nroSucursal, $tipoMovimiento, $cantidad, $observacion, $idTipo, $cantidadKilos, $fecha) {


        $dbh = $this->cid;
        if($idTipo == 0){
            $stmt = $dbh->prepare("INSERT INTO ph_movimiento_cuenta ( nro_sucursal, tipo_movimiento, importe,observaciones,franquicia_fabrica,cantidad_kilos,created_at) VALUES (?,?,?,?,?,?,?);");

        }else{

            $stmt = $dbh->prepare("INSERT INTO ph_movimiento_cuenta ( nro_sucursal, tipo_movimiento, cantidad,observaciones,franquicia_fabrica,cantidad_kilos,created_at) VALUES (?,?,?,?,?,?,?);");
        }
        $hourMin = date('Hi');
        $stmt->bindParam(1, $nroSucursal);
        $stmt->bindParam(2, $tipoMovimiento);
        $stmt->bindParam(3, $cantidad);
        $stmt->bindParam(4, $observacion);
        $stmt->bindParam(5, $idTipo);
        $stmt->bindParam(6, $cantidadKilos);
        $stmt->bindParam(7, $fecha);


        try {

            $stmt->execute();
            return ;

        }catch (\Throwable $th) {

            return $th;

        }

    } 

    public function getFranquicia ($nroSucursal) {
                
        $dbh = $this->cid;
        

        $stmt = $dbh->prepare("SELECT a.*,b.valor FROM ph_movimiento_cuenta a
        inner join ph_maestro_de_valores b on a.tipo_movimiento = b.tipo_movimiento 
        where nro_sucursal = $nroSucursal AND franquicia_fabrica = 1 ");
        $hourMin = date('Hi');
 
        try {

            $stmt->execute();
            $datos = $stmt->fetchAll(); 
            return $datos;

        }catch (\Throwable $th) {

            return $th;

        }

    } 
    public function getListadoFranquicia ($mes, $anio) {
                
        $dbh = $this->cid;

    
        // $sql = "SELECT a.*, WEEK(created_at) AS numero_semana, b.LOCAL  
        // FROM ph_movimiento_cuenta a
        // inner join ph_locales b on a.nro_sucursal = b.NRO_LOCAL 
        // where franquicia_fabrica = 1 
        // and tipo_movimiento like '%salida%'
        // and MONTH(created_at) like '$mes'
        // and YEAR(created_at) like '$anio'";

        $sql = "SELECT a.*, WEEK(created_at) AS numero_semana, b.LOCAL,c.valor
        FROM ph_movimiento_cuenta a 
        inner join ph_locales b on a.nro_sucursal = b.NRO_LOCAL 
        inner join ph_maestro_de_valores c on a.tipo_movimiento = c.tipo_movimiento 
        where franquicia_fabrica = 1 
        and a.tipo_movimiento like '%salida%' 
        and MONTH(created_at) like '$mes' 
        and YEAR(created_at) like '$anio'";


        $stmt = $dbh->prepare($sql);

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
        if($idTipo == 0){
            $stmt = $dbh->prepare(" SELECT a.* FROM ph_movimiento_cuenta a
            where nro_sucursal = $nroSucursal and franquicia_fabrica = 0 ");
        }else{
            $stmt = $dbh->prepare(" SELECT a.*,b.valor FROM ph_movimiento_cuenta a
            inner join ph_maestro_de_valores b on a.tipo_movimiento = b.tipo_movimiento 
            where nro_sucursal = $nroSucursal and franquicia_fabrica = $idTipo ");
        }
        $hourMin = date('Hi');
 
        try {

            $stmt->execute();
            $datos = $stmt->fetchAll(); 
            return $datos;

        }catch (\Throwable $th) {

            return $th;

        }

    } 
    public function getDetalleTachos ($nroSucursal, $fecha,$tipoMovimiento = null){

        $dbh = $this->cid;
        $sql = " SELECT a.*,b.valor FROM ph_movimiento_cuenta a
        inner join ph_maestro_de_valores b on a.tipo_movimiento = b.tipo_movimiento 
        where nro_sucursal = $nroSucursal and franquicia_fabrica = '1' and a.tipo_movimiento = '$tipoMovimiento' and created_at like '%$fecha%' ";

        $stmt = $dbh->prepare($sql);

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