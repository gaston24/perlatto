<?php

include __DIR__."/../../Class/grupos.php";    

var_dump($_POST);

$grupo = new Grupo();


$codGrupo = $_POST['codGrupo'];

//MODIFICAR LOCAL
$grupo->eliminarGrupo($codGrupo);

echo $codGrupo.' - Eliminado';