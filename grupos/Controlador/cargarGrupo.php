<?php

include __DIR__."/../../Class/grupos.php";   
 

$grupo = new Grupo();


$datos = $_POST['matrizGrupo'];

$codGrupo = $datos[0];
$descGrupo = $datos[1];


//INSERTAR GRUPO
$grupo->insertarGrupo($codGrupo, $descGrupo);

echo $codGrupo.' - '.$descGrupo;