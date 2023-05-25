<?php
require_once(__DIR__.'/Class/classEnv.php');
$vars = new DotEnv(__DIR__ . '/.env');
$envVars = $vars->listVars();
$env = strtolower($envVars['ENV']);

$prefijo = '';

if($env == 'new'){
    $prefijo = '/pedidos__dev_new';
}else if($env == 'prod'){
    $prefijo = '/pedidos__dev';
}else if($env == 'dev'){
    $prefijo = '/perlatto';
}