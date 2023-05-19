<?php
include __DIR__."/../../Class/locales.php";   

$cuenta = new Local();

$result = $cuenta->traerNombreLocales();

echo  json_encode($result);