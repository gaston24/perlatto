<?php

class Usuarios
{
    function __construct(){

        require_once 'conexion.php';
        $this->conn = new Conexion;
        $this->cid = $this->conn->conectar();
        $this->dbh = $this->cid;
        
    }

    public function login($a, $b){

        $stmt = $this->dbh->prepare("SELECT * FROM ph_usuarios WHERE ESTADO = 1 AND NAME = '$a' AND PASS = '$b'");
        $stmt->execute(); 
        $okUser = $stmt->rowCount();
        return $okUser;

    }


    public function traerUno($a, $b){

        $stmt = $this->dbh->prepare("SELECT DESCRIPCION, TIPO, A.NRO_LOCAL FROM ph_usuarios A LEFT JOIN ph_locales B ON A.ID_USUARIO = B.ID_USUARIO WHERE ESTADO = 1 AND NAME = '$a' AND PASS = '$b'");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }

    public function traerPorNum($nroLocal){

        $stmt = $this->dbh->prepare("SELECT A.NAME, A.PASS, A.ESTADO, B.* FROM ph_usuarios A LEFT JOIN ph_locales B ON A.ID_USUARIO = B.ID_USUARIO WHERE A.NRO_LOCAL = $nroLocal ");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }




    public function traerTodos(){

        $stmt = $this->dbh->prepare("SELECT * FROM ph_usuarios");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;
        
    }

    public function traerUsuariosLocales(){

        $stmt = $this->dbh->prepare("SELECT A.NRO_LOCAL, A.DESCRIPCION, B.CONTACTO, B.TELEFONO_1 TELEFONO, B.EMAIL, CASE ESTADO WHEN 1 THEN 'OK' ELSE 'DESHABILITADO' END ESTADO FROM ph_usuarios A LEFT JOIN ph_locales B ON A.ID_USUARIO = B.ID_USUARIO WHERE NAME != 'ADMIN' ");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }

    


    public function traerFiltrado($columna, $filtro){

        $stmt = $this->dbh->prepare("SELECT * FROM ph_usuarios WHERE $columna LIKE '%$filtro%'");
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $dato = $stmt->fetchAll(); 
        return $dato;

    }



    public function traerSigLocal(){

        $stmt = $this->dbh->prepare("SELECT MAX(NRO_LOCAL)+1 FROM ph_locales ");
        $stmt->bindParam(1, $talonario);
        $stmt->execute();
        $dato = $stmt->fetchColumn(0); 
        return $dato;

    }



    public function insertarUserLocal($nroLocal, $name, $pass, $descripcion){
        
        $stmt = $this->dbh->prepare("INSERT INTO ph_usuarios (NRO_LOCAL, NAME, PASS, DESCRIPCION, TIPO) VALUES (?, ?, ?, ?, ?)");
        $tipo = "LOCAL";

        $stmt->bindParam(1, $nroLocal);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $pass);
        $stmt->bindParam(4, $descripcion);
        $stmt->bindParam(5, $tipo);
        
        $stmt->execute();
    }




    public function modificarUserLocal($nroLocal, $name, $pass, $descripcion, $estado){
        
        $stmt = $this->dbh->prepare("UPDATE ph_usuarios SET NAME = ?, PASS = ?, DESCRIPCION = ?, ESTADO = ? WHERE NRO_LOCAL = ?");

        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $pass);
        $stmt->bindParam(3, $descripcion);
        $stmt->bindParam(4, $estado);
        $stmt->bindParam(5, $nroLocal);
        
        $stmt->execute();
    }





}





