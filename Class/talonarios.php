<?php

class Talonario
{
    public function traerUno($talonario){
        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("SELECT NUM_SIGUIENTE FROM ph_talonario WHERE PREFIJO = ?");
        $stmt->bindParam(1, $talonario);
        $stmt->execute();
        $dato = $stmt->fetchColumn(0); 
        return $dato;
    }

    public function actualizarSiguiente($talonario){
        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("UPDATE ph_talonario SET NUM_SIGUIENTE = NUM_SIGUIENTE+1 WHERE PREFIJO = ?");
        $stmt->bindParam(1, $talonario);
        $stmt->execute();
    }
    
    
}