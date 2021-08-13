<?php

/* 
dev = 1
produccion = 2
*/
$entorno = 2;

if($entorno == 1){

  try {

    $dbname = "perlattohelados_com_ar";
    $dsn = "mysql:host=localhost;dbname=$dbname";
    $options = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    $user = "root";
    $password = "";
    $dbh = new PDO($dsn, $user, $password);
  } catch (PDOException $e){
    echo $e->getMessage();
  }

}elseif ($entorno == 2) {

  try {

    $dbname = "perlattohelados_com_ar";
    $dsn = "mysql:host=aplin.amalthea.dreamhost.com;dbname=$dbname";
    $options = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    $user = "perlattoheladosc";
    $password = "W3Rfxz!y";
    $dbh = new PDO($dsn, $user, $password);
  } catch (PDOException $e){
    echo 'hay un error en la conexion';
    echo $e->getMessage();
  }
  
} 


