<?php

/* 
dev = 1
produccion = 2
*/
$entorno = 1;

if($entorno == 1){

  try {

    $dbname = "bdperlatto";
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

    $dbname = "monichei_wp837";
    $dsn = "mysql:host=localhost;dbname=$dbname";
    $options = array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    $user = "monichei_wp837";
    $password = "5S-4uCp95@";
    $dbh = new PDO($dsn, $user, $password);
  } catch (PDOException $e){
    echo $e->getMessage();
  }
  
} 


