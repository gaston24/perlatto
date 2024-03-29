<?php

class Produccion 
{

    public function limpiarAuxiliar(){
        include __DIR__."/../AccesoDatos/conn.php";
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        
        $stmt = $dbh->prepare("TRUNCATE TABLE ph_stock_aux");

        $stmt->execute();
    }


    public function insertarAuxiliar($codGusto, $fecha, $partida, $numPartida, $operario, $peso, $numTacho){
        include __DIR__."/../AccesoDatos/conn.php";
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        
        $stmt = $dbh->prepare("INSERT INTO ph_stock_aux (FECHA, COD_GUSTO, PESO, PARTIDA, NUM_PARTIDA, OPERARIO, NUM_TACHO) VALUES(?, ?, ?, ?, ?, ?, ? )");
        $hourMin = date('Hi');
        $stmt->bindParam(1, $fecha);
        $stmt->bindParam(2, $codGusto);
        $stmt->bindParam(3, $peso);
        $stmt->bindParam(4, $partida);
        $stmt->bindParam(5, $numPartida);
        $stmt->bindParam(6, $operario);
        $stmt->bindParam(7, $numTacho);
        $stmt->execute();
    }

    public function pendientesAux(){
        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("SELECT * FROM ph_stock_aux ");

        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }

    public function ingresarStock(){
        include __DIR__."/../AccesoDatos/conn.php";
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        
        $stmt = $dbh->prepare("INSERT INTO ph_stock (FECHA, COD_GUSTO, PESO, PARTIDA, NUM_PARTIDA, OPERARIO, NUM_TACHO) SELECT FECHA, COD_GUSTO, PESO, PARTIDA, NUM_PARTIDA, OPERARIO, NUM_TACHO FROM ph_stock_aux");
        $hourMin = date('Hi');

        $stmt->execute();
    }

    public function stockActual(){
        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("SELECT B.GRUPO, A.COD_GUSTO, B.DESC_GUSTO, COUNT(A.COD_GUSTO) TACHOS, SUM(A.PESO) PESO FROM ph_stock A INNER JOIN ph_gustos B ON A.COD_GUSTO COLLATE utf8mb4_general_ci = B.COD_GUSTO COLLATE utf8mb4_general_ci WHERE A.ESTADO = 1 GROUP BY A.COD_GUSTO, B.DESC_GUSTO ORDER BY A.COD_GUSTO ");

        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }


    public function stockGusto($codGusto){
        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("SELECT A.FECHA, A.PARTIDA, A.OPERARIO, B.GRUPO, A.COD_GUSTO, B.DESC_GUSTO, A.PESO FROM ph_stock A INNER JOIN ph_gustos B ON A.COD_GUSTO COLLATE utf8mb4_general_ci = B.COD_GUSTO COLLATE utf8mb4_general_ci WHERE A.ESTADO = 1 AND A.COD_GUSTO = ? ORDER BY A.FECHA");
        $stmt->bindParam(1, $codGusto);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }



}