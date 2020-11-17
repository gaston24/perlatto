<?php

class Usuarios
{

    public function login($a, $b){

        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("SELECT * FROM ph_usuarios WHERE ESTADO = 1 AND NAME = '$a' AND PASS = '$b'");
        $stmt->execute(); 
        $okUser = $stmt->rowCount();
        return $okUser;
    }


    public function traerUno($a, $b){

        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("SELECT DESCRIPCION, TIPO, A.NRO_LOCAL FROM ph_usuarios A LEFT JOIN ph_locales B ON A.ID_USUARIO = B.ID_USUARIO WHERE ESTADO = 1 AND NAME = '$a' AND PASS = '$b'");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }

    public function traerPorNum($nroLocal){

        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("SELECT A.NAME, A.PASS, A.ESTADO, B.* FROM ph_usuarios A LEFT JOIN ph_locales B ON A.ID_USUARIO = B.ID_USUARIO WHERE A.NRO_LOCAL = $nroLocal ");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }




    public function traerTodos(){

        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("SELECT * FROM ph_usuarios");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;
    }

    public function traerUsuariosLocales(){

        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("SELECT A.NRO_LOCAL, A.DESCRIPCION, B.CONTACTO, B.TELEFONO_1 TELEFONO, B.EMAIL, CASE ESTADO WHEN 1 THEN 'OK' ELSE 'DESHABILITADO' END ESTADO FROM ph_usuarios A LEFT JOIN ph_locales B ON A.ID_USUARIO = B.ID_USUARIO WHERE NAME != 'ADMIN' ");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }

    


    public function traerFiltrado($columna, $filtro){

        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("SELECT * FROM ph_usuarios WHERE $columna LIKE '%$filtro%'");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }



    public function traerSigLocal(){

        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("SELECT MAX(NRO_LOCAL)+1 FROM ph_locales ");
        $stmt->bindParam(1, $talonario);
        $stmt->execute();
        $dato = $stmt->fetchColumn(0); 
        return $dato;

    }



    public function insertarUserLocal($nroLocal, $name, $pass, $descripcion){
        
        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("INSERT INTO ph_usuarios (NRO_LOCAL, NAME, PASS, DESCRIPCION, TIPO) VALUES (?, ?, ?, ?, ?)");
        $tipo = "LOCAL";

        $stmt->bindParam(1, $nroLocal);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $pass);
        $stmt->bindParam(4, $descripcion);
        $stmt->bindParam(5, $tipo);
        
        $stmt->execute();
    }




    public function modificarUserLocal($nroLocal, $name, $pass, $descripcion, $estado){
        
        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("UPDATE ph_usuarios SET NAME = ?, PASS = ?, DESCRIPCION = ?, ESTADO = ? WHERE NRO_LOCAL = ?");

        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $pass);
        $stmt->bindParam(3, $descripcion);
        $stmt->bindParam(4, $estado);
        $stmt->bindParam(5, $nroLocal);
        
        $stmt->execute();
    }





}





