<?php

include __DIR__."/../../Class/gustos.php";   
 

$gusto = new Gusto();


$datos = $_POST['matrizGusto'];

$codGrupo = $datos[0];
$codGusto = $datos[1];
$descGusto = $datos[2];

//INSERTAR USUARIO
$gusto->insertarGusto($codGrupo, $codGusto, $descGusto);

echo $codGrupo.' - '.$codGusto.' - '.$descGusto;