<?php

class Talonario
{
    function __construct(){

        require_once 'conexion.php';
        $this->conn = new Conexion;
        $this->cid = $this->conn->conectar();
        
    }

    public function traerUno($talonario){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("SELECT NUM_SIGUIENTE FROM ph_talonario WHERE PREFIJO = ?");
        $stmt->bindParam(1, $talonario);
        $stmt->execute();
        $dato = $stmt->fetchColumn(0); 
        return $dato;
    }

    public function actualizarSiguiente($talonario){
        $dbh = $this->cid;
        $stmt = $dbh->prepare("UPDATE ph_talonario SET NUM_SIGUIENTE = NUM_SIGUIENTE+1 WHERE PREFIJO = ?");
        $stmt->bindParam(1, $talonario);
        $stmt->execute();
    }
    
    
}