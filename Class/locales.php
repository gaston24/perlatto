<?php

class Local
{
    public function insertarLocal($nroLocal, $descLocal, $direccion, $localidad, $provincia, $contacto, $telefono1, $telefono2, $email, $cuit){
        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("INSERT INTO ph_locales 
        (ID_USUARIO, NRO_LOCAL, LOCAL, DIRECCION, LOCALIDAD, PROVINCIA, CONTACTO, TELEFONO_1, TELEFONO_2, EMAIL, CUIT)
        VALUES
        ((SELECT ID_USUARIO FROM ph_usuarios WHERE NRO_LOCAL = ?), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");

        $stmt->bindParam(1, $nroLocal);
        $stmt->bindParam(2, $nroLocal);
        $stmt->bindParam(3, $descLocal);
        $stmt->bindParam(4, $direccion);
        $stmt->bindParam(5, $localidad);
        $stmt->bindParam(6, $provincia);
        $stmt->bindParam(7, $contacto);
        $stmt->bindParam(8, $telefono1);
        $stmt->bindParam(9, $telefono2);
        $stmt->bindParam(10, $email);
        $stmt->bindParam(11, $cuit);
        
        $stmt->execute();
    }





    public function modificarLocal($nroLocal, $descLocal, $direccion, $localidad, $provincia, $contacto, $telefono1, $telefono2, $email, $cuit){
        include __DIR__."/../AccesoDatos/conn.php";
        $stmt = $dbh->prepare("UPDATE ph_locales SET LOCAL = ?, DIRECCION = ?, LOCALIDAD = ?, PROVINCIA = ?, CONTACTO = ?, TELEFONO_1 = ?, TELEFONO_2 = ?, EMAIL = ?, CUIT = ? WHERE NRO_LOCAL = ?");

        $stmt->bindParam(1, $descLocal);
        $stmt->bindParam(2, $direccion);
        $stmt->bindParam(3, $localidad);
        $stmt->bindParam(4, $provincia);
        $stmt->bindParam(5, $contacto);
        $stmt->bindParam(6, $telefono1);
        $stmt->bindParam(7, $telefono2);
        $stmt->bindParam(8, $email);
        $stmt->bindParam(9, $cuit);
        $stmt->bindParam(10, $nroLocal);
        
        $stmt->execute();
    }






}