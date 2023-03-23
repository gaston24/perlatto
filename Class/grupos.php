<?php

class Grupo
{

    function __construct(){

        require_once 'conexion.php';
        $this->conn = new Conexion;
        $this->cid = $this->conn->conectar();
        $this->dbh = $this->cid;
        
    }

    public function traerTodos(){

        $stmt = $this->dbh->prepare("SELECT * FROM ph_grupos");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;
    }


    public function insertarGrupo($codGrupo, $descGrupo){
         
        try {
            $stmt = $this->dbh->prepare("INSERT INTO ph_grupos (COD_GRUPO, DESC_GRUPO) VALUES (?, ?)");
            $stmt->bindParam(1, $codGrupo);
            $stmt->bindParam(2, $descGrupo);
            $stmt->execute();

        } catch (MiExcepción $e) {      // Será atrapada
            return "Atrapada mi excepción\n". $e;

        } 

        

    }


    public function eliminarGrupo($codGrupo){

        $stmt = $this->dbh->prepare("DELETE FROM ph_grupos WHERE COD_GRUPO = ?");

        $stmt->bindParam(1, $codGrupo);
        
        $stmt->execute();

    }


}