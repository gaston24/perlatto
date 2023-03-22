<?php
include __DIR__."/../../Class/locales.php";   

$cuenta = new Local();

$result = $cuenta->traerLocales();

print_r ($result);