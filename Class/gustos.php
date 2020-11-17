<?php

class Gusto
{



    public function traerUno($a){

        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("SELECT * FROM ph_gustos WHERE COD_GUSTO = '$a'");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }

    public function traerTodos(){

        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("SELECT GRUPO, COD_GUSTO, DESC_GUSTO, CASE ESTADO WHEN 1 THEN 'OK' ELSE 'DESHABILITADO' END ESTADO FROM ph_gustos ORDER BY GRUPO, COD_GUSTO");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;
    }


    public function traerActivos(){

        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("SELECT * FROM ph_gustos WHERE ESTADO = 1 ORDER BY GRUPO, DESC_GUSTO");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;
    }

    public function insertarGusto($codGrupo, $codGusto, $descGusto){
        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("INSERT INTO ph_gustos (GRUPO, COD_GUSTO, DESC_GUSTO) VALUES (?, ?, ?)");

        $stmt->bindParam(1, $codGrupo);
        $stmt->bindParam(2, $codGusto);
        $stmt->bindParam(3, $descGusto);
        
        $stmt->execute();
    }


    public function modificarGusto($gustoOriginal, $codGrupo, $codGusto, $descGusto, $estado){
        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("UPDATE ph_gustos SET GRUPO = ?, COD_GUSTO = ?, DESC_GUSTO = ?, ESTADO = ? WHERE COD_GUSTO = ?");

        $stmt->bindParam(1, $codGrupo);
        $stmt->bindParam(2, $codGusto);
        $stmt->bindParam(3, $descGusto);
        $stmt->bindParam(4, $estado);
        $stmt->bindParam(5, $gustoOriginal);
        
        $stmt->execute();
    }


    public function modificarGustoPedidos($gustoOriginal, $codGusto){
        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("UPDATE ph_pedidos_det SET COD_GUSTO = ? WHERE COD_GUSTO = ?");

        $stmt->bindParam(1, $codGusto);
        $stmt->bindParam(2, $gustoOriginal);

        
        $stmt->execute();
    }


}





