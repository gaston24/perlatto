<?php

include __DIR__."/../../Class/gustos.php";     

$gusto = new Gusto();

$datos = $_POST['matrizGustoMod'];

$gustoOriginal = $datos[0];
$codGrupo = $datos[1];
$codGusto = $datos[2];
$descGusto = $datos[3];
$estado = $datos[4];

// print_r($datos);

//MODIFICAR GUSTO
$gusto->modificarGusto($gustoOriginal, $codGrupo, $codGusto, $descGusto, $estado);
$gusto->modificarGustoPedidos($gustoOriginal, $codGusto);

echo $codGrupo.' - '.$codGusto.' - '.$descGusto.' - '; if ($estado == '1'){echo 'HABILITADO';}else{echo 'DESHABILITADO';};