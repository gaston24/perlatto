<?php

class Maestro 
{

    function __construct(){

        require_once 'conexion.php';
        $this->conn = new Conexion;
        $this->cid = $this->conn->conectar();
        
    }

    public function insertarNuevo ($descripcion,$costo) {

                
        $dbh = $this->cid;

        $stmt = $dbh->prepare("INSERT INTO ph_maestro_de_valores ( descripcion, valor) VALUES (?,?);");
        $hourMin = date('Hi');
        $stmt->bindParam(1, $descripcion);
        $stmt->bindParam(2, $costo);

        try {

            $stmt->execute();
            return ;

        }catch (\Throwable $th) {

            return $th;

        }

    } 

    public function traerTodos () {
                
        $dbh = $this->cid;

        $stmt = $dbh->prepare(" SELECT * FROM ph_maestro_de_valores ");
        $hourMin = date('Hi');
 
        try {

            $stmt->execute();
            $datos = $stmt->fetchAll(); 
            return $datos;

        }catch (\Throwable $th) {

            return $th;

        }

    } 

    public function eliminar ($id) {

        $dbh = $this->cid;

        $stmt = $dbh->prepare("DELETE  FROM ph_maestro_de_valores WHERE id = $id");
        $hourMin = date('Hi');
 
        try {

            $stmt->execute();

            return true;

        }catch (\Throwable $th) {

            return $th;

        }

    } 
    public function traerPorId($id){
        
        $dbh = $this->cid;

        $stmt = $dbh->prepare(" SELECT * FROM ph_maestro_de_valores WHERE id = $id");
        $hourMin = date('Hi');
 
        try {

            $stmt->execute();
            $datos = $stmt->fetchAll(); 
            return $datos;

        }catch (\Throwable $th) {

            return $th;

        }
    }

    public function actualizar($id, $descripcion, $costo){
                
        $dbh = $this->cid;

        $stmt = $dbh->prepare("UPDATE  ph_maestro_de_valores SET descripcion = '$descripcion', costo = '$costo' WHERE id = $id");
        $hourMin = date('Hi');
 
        try {

            $stmt->execute();
        
            return true;

        }catch (\Throwable $th) {

            return $th;

        }
    }

}