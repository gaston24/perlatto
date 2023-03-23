<?php

class Dia
{

    function __construct(){

        require_once 'conexion.php';
        $this->conn = new Conexion;
        $this->cid = $this->conn->conectar();
        $this->dbh = $this->cid;
        
    }

    public function insertarFechaEntrega($nroLocal, $lu, $ma, $mi, $ju, $vi, $sa, $do){

        $stmt = $this->dbh->prepare("INSERT INTO ph_dias_entrega 
        (NRO_LOCAL, LUNES, MARTES, MIERCOLES, JUEVES, VIERNES, SABADO, DOMINGO)
        VALUES
        (?, ?, ?, ?, ?, ?, ?, ?);");

        $stmt->bindParam(1, $nroLocal);
        $stmt->bindParam(2, $lu);
        $stmt->bindParam(3, $ma);
        $stmt->bindParam(4, $mi);
        $stmt->bindParam(5, $ju);
        $stmt->bindParam(6, $vi);
        $stmt->bindParam(7, $sa);
        $stmt->bindParam(8, $do);
        
        $stmt->execute();

    }

    public function modificarFechaEntrega($nroLocal, $lu, $ma, $mi, $ju, $vi, $sa, $do){

        $stmt = $this->dbh->prepare("UPDATE ph_dias_entrega SET LUNES = ?, MARTES = ?, MIERCOLES = ?, JUEVES = ?, VIERNES = ?, SABADO = ?, DOMINGO = ? WHERE (NRO_LOCAL = ?)");

        $stmt->bindParam(1, $lu);
        $stmt->bindParam(2, $ma);
        $stmt->bindParam(3, $mi);
        $stmt->bindParam(4, $ju);
        $stmt->bindParam(5, $vi);
        $stmt->bindParam(6, $sa);
        $stmt->bindParam(7, $do);
        $stmt->bindParam(8, $nroLocal);
        
        $stmt->execute();

    }


    public function traerPorNumDiasEntrega($nroLocal){
 
        $stmt = $this->dbh->prepare("SELECT LUNES, MARTES, MIERCOLES, JUEVES, VIERNES, SABADO, DOMINGO FROM ph_dias_entrega WHERE NRO_LOCAL = $nroLocal ");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }


    public function traerProxFechaEntrega($nroLocal){

        $stmt = $this->dbh->prepare("CALL TRAER_PROX_FECHA(?)");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(1, $nroLocal, PDO::PARAM_INT);
        $stmt->execute();
        $dato = $stmt->fetchColumn(0); 
        return $dato;


    }


}

//CASE WHEN dayofweek(now())-2 = -1 THEN 6 ELSE dayofweek(now())-2 END